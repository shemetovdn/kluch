<?


namespace wbp\urlManager;

use backend\models\Languages;
use PDO;
use Yii;

/**
 * EDbUrlRule class.
 * Provides support for dynamic URL rules.
 *
 * @author Rodrigo Coelho <ext.dev@contas.rodrigocoelho.com.br>
 * @copyright Copyright &copy; 2010 Rodrigo Coelho
 * @license http://www.yiiframework.com/license/ Yii Framework License
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @package ext.DbUrlManager
 */
class UrlRule extends \yii\web\UrlRule {

    /**
     * @var string the type of the URL rule.
     * Legal values are: null; 'db': dynamic db-based URL rule.
     * @since 1.0
     */
    public $type;
    /**
     * @var array the mapping from route param name to table and field names, e.g. 'paramName'=>array('tableName'=>'fieldName')
     */
    public $fields = array();

    /**
     * @var array additional params for DB check
     */
    public $additionalAttr = [];
    public $enableLanguageDepend = false,$languageDependField = 'language_id';


    /**
     * @var string the template for generating a new URL. This is derived from [[pattern]] and is used in generating URL.
     */
    private $_template;
    /**
     * @var string the regex for matching the route part. This is used in generating URL.
     */
    private $_routeRule;
    /**
     * @var array list of regex for matching parameters. This is used in generating URL.
     */
    private $_paramRules = [];
    /**
     * @var array list of parameters used in the route.
     */
    private $_routeParams = [];


    /**
     * Overrides {@link UrlRule::init}
     * Init. Stores the rules' new properties, then call the parent constructor.
     */


    public function init()
    {
        if (is_array($this->route)) {
            if (isset($this->route['type']))
                $this->type = $this->route['type'];
            if (isset($this->route['fields']))
                $this->fields = $this->route['fields'];
        }

        if ($this->pattern === null) {
            throw new InvalidConfigException('UrlRule::pattern must be set.');
        }
        if ($this->route === null) {
            throw new InvalidConfigException('UrlRule::route must be set.');
        }
        if ($this->verb !== null) {
            if (is_array($this->verb)) {
                foreach ($this->verb as $i => $verb) {
                    $this->verb[$i] = strtoupper($verb);
                }
            } else {
                $this->verb = [strtoupper($this->verb)];
            }
        }
        if ($this->name === null) {
            $this->name = $this->pattern;
        }

        $this->pattern = trim($this->pattern, '/');

        if ($this->host !== null) {
            $this->host = rtrim($this->host, '/');
            $this->pattern = rtrim($this->host . '/' . $this->pattern, '/');
        } elseif ($this->pattern === '') {
            $this->_template = '';
            $this->pattern = '#^$#u';
            return;
        } elseif (($pos = strpos($this->pattern, '://')) !== false) {
            if (($pos2 = strpos($this->pattern, '/', $pos + 3)) !== false) {
                $this->host = substr($this->pattern, 0, $pos2);
            } else {
                $this->host = $this->pattern;
            }
        } else {
            $this->pattern = '/' . $this->pattern . '/';
        }

        $this->route = trim($this->route, '/');
        if (strpos($this->route, '<') !== false && preg_match_all('/<(\w+)>/', $this->route, $matches)) {
            foreach ($matches[1] as $name) {
                $this->_routeParams[$name] = "<$name>";
            }
        }

        $tr = [
            '.' => '\\.',
            '*' => '\\*',
            '$' => '\\$',
            '[' => '\\[',
            ']' => '\\]',
            '(' => '\\(',
            ')' => '\\)',
        ];
        $tr2 = [];
        if (preg_match_all('/<(\w+):?([^>]+)?>/', $this->pattern, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $name = $match[1][0];
                $pattern = isset($match[2][0]) ? $match[2][0] : '[^\/]+';
                if (array_key_exists($name, $this->defaults)) {
                    $length = strlen($match[0][0]);
                    $offset = $match[0][1];
                    if ($offset > 1 && $this->pattern[$offset - 1] === '/' && $this->pattern[$offset + $length] === '/') {
                        $tr["/<$name>"] = "(/(?P<$name>$pattern))?";
                    } else {
                        $tr["<$name>"] = "(?P<$name>$pattern)?";
                    }
                } else {
                    $tr["<$name>"] = "(?P<$name>$pattern)";
                }
                if (isset($this->_routeParams[$name])) {
                    $tr2["<$name>"] = "(?P<$name>$pattern)";
                } else {
                    $this->_paramRules[$name] = $pattern === '[^\/]+' ? '' : "#^$pattern$#u";
                }
            }
        }
        $this->_template = preg_replace('/<(\w+):?([^>]+)?>/', '<$1>', $this->pattern);
        $this->pattern = '#^' . trim(strtr($this->_template, $tr), '/') . '$#u';

        if (!empty($this->_routeParams)) {
            $this->_routeRule = '#^' . strtr($this->route, $tr2) . '$#u';
        }

    }


    public function parseRequest($manager, $request)
    {
        if ($this->mode === self::CREATION_ONLY) {
            return false;
        }

        if (!empty($this->verb) && !in_array($request->getMethod(), $this->verb, true)) {
            return false;
        }

        $pathInfo = $request->getPathInfo();
        $suffix = (string) ($this->suffix === null ? $manager->suffix : $this->suffix);
        if ($suffix !== '' && $pathInfo !== '') {
            $n = strlen($suffix);
            if (substr_compare($pathInfo, $suffix, -$n, $n) === 0) {
                $pathInfo = substr($pathInfo, 0, -$n);
                if ($pathInfo === '') {
                    // suffix alone is not allowed
                    return false;
                }
            } else {
                return false;
            }
        }

        if ($this->host !== null) {
            $pathInfo = strtolower($request->getHostInfo()) . ($pathInfo === '' ? '' : '/' . $pathInfo);
        }

        if (!preg_match($this->pattern, $pathInfo, $matches)) {
            return false;
        }

        /* ADDED TO DEFAULT METHOD FOR CHECKING DB */
        if (!$this->handleParseMatch($manager, $matches)) return false;

        /* --------------------------------------- */
        foreach ($this->defaults as $name => $value) {
            if (!isset($matches[$name]) || $matches[$name] === '') {
                $matches[$name] = $value;
            }
        }
        $params = $this->defaults;
        $tr = [];
        foreach ($matches as $name => $value) {
            if (isset($this->_routeParams[$name])) {
                $tr[$this->_routeParams[$name]] = $value;
                unset($params[$name]);
            } elseif (isset($this->_paramRules[$name])) {
                $params[$name] = $value;
            }
        }

        if ($this->_routeRule !== null) {
            $route = strtr($this->route, $tr);
        } else {
            $route = $this->route;
        }

        Yii::trace("Request parsed with URL rule: {$this->name}", __METHOD__);

        return [$route, $params];
    }


    /**
     * This method is invoked upon a rule match by {@link EDbUrlRule::parseUrl}.
     * If the rule type is 'db', {@link EDbUrlRule::checkDbRule} is called.
     * @param CUrlManager the URL manager
     * @param array the regex matches as found by {@link CUrlRule::parseUrl}
     * @return boolean whether the matched rule should be used.
     * @since 1.0
     */
    protected function handleParseMatch($manager, $matches) {
        if ($this->type !== 'db')
            return true;

        foreach ($matches as $key => $value) {
            if (isset($this->fields[$key]))
                $this->fields[$key]['value'] = $value;
        }
        return $this->checkDbRule($manager);
    }

    /**
     * Checks the URL rule against the path info from the current request.
     * @return boolean whether the URL matches the data in the database.
     * @since 1.0
     */
    protected function checkDbRule($manager) {
        $tables=array();
        foreach ($this->fields as $param => $data) {
            $tables[$data['table']][]=$data;
        }


        foreach ($tables as $tbl_name => $data) {
            $sql_array=array();
            foreach($data as $field){
                $sql_array[]=" {$field['field']}=:{$field['field']} ";
            }


            if($this->enableLanguageDepend === true){
                $this->additionalAttr[$this->languageDependField]=Languages::currentId();
            }


            if(count($this->additionalAttr) > 0){
                foreach($this->additionalAttr as $field=>$value){
                    $sql_array[]=" {$field}=:{$field} ";
                }
            }
            $sql = "SELECT * FROM {$manager->getDbConnection()->tablePrefix}{$tbl_name} WHERE 1 AND ".implode("AND",$sql_array)." LIMIT 1";
//        echo $sql; exit();
            $command = $manager->getDbConnection()->createCommand($sql);

            foreach($data as $field){
                $command->bindValue(":{$field['field']}", $field['value'], PDO::PARAM_STR);
            }

            foreach($this->additionalAttr as $field=>$value){
                $command->bindValue(":{$field}", $value, PDO::PARAM_STR);
            }
            if ($command->queryScalar() === false)
                return false;
        }
        return true;
    }

    /**
     * Creates a URL according to the given route and parameters.
     * @param UrlManager $manager the URL manager
     * @param string $route the route. It should not have slashes at the beginning or the end.
     * @param array $params the parameters
     * @return string|boolean the created URL, or false if this rule cannot be used for creating this URL.
     */
    public function createUrl($manager, $route, $params)
    {
        if ($this->mode === self::PARSING_ONLY) {
            return false;
        }

        $tr = [];

        // match the route part first
        if ($route !== $this->route) {
            if ($this->_routeRule !== null && preg_match($this->_routeRule, $route, $matches)) {
                foreach ($this->_routeParams as $name => $token) {
                    if (isset($this->defaults[$name]) && strcmp($this->defaults[$name], $matches[$name]) === 0) {
                        $tr[$token] = '';
                    } else {
                        $tr[$token] = $matches[$name];
                    }
                }
            } else {
                return false;
            }
        }

        // match default params
        // if a default param is not in the route pattern, its value must also be matched
        foreach ($this->defaults as $name => $value) {
            if (isset($this->_routeParams[$name])) {
                continue;
            }
            if (!isset($params[$name])) {
                return false;
            } elseif (strcmp($params[$name], $value) === 0) { // strcmp will do string conversion automatically
                unset($params[$name]);
                if (isset($this->_paramRules[$name])) {
                    $tr["<$name>"] = '';
                }
            } elseif (!isset($this->_paramRules[$name])) {
                return false;
            }
        }

        // match params in the pattern
        foreach ($this->_paramRules as $name => $rule) {
            if (isset($params[$name]) && !is_array($params[$name]) && ($rule === '' || preg_match($rule, $params[$name]))) {
                $tr["<$name>"] = $this->encodeParams ? urlencode($params[$name]) : $params[$name];
                unset($params[$name]);
            } elseif (!isset($this->defaults[$name]) || isset($params[$name])) {
                return false;
            }
        }

        $url = trim(strtr($this->_template, $tr), '/');
        if ($this->host !== null) {
            $pos = strpos($url, '/', 8);
            if ($pos !== false) {
                $url = substr($url, 0, $pos) . preg_replace('#/+#', '/', substr($url, $pos));
            }
        } elseif (strpos($url, '//') !== false) {
            $url = preg_replace('#/+#', '/', $url);
        }

        if ($url !== '') {
            $url .= ($this->suffix === null ? $manager->suffix : $this->suffix);
        }

        if (!empty($params) && ($query = http_build_query($params)) !== '') {
            $url .= '?' . $query;
        }

        return $url;
    }

}
?>