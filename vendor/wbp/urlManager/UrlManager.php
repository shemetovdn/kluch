<?php

namespace wbp\urlManager;

use backend\models\Languages;
use wbp\lang\Lang;
use Yii;

/**
 * TODO: I18N
 * TODO: Caching
 * TODO: Test the queries with multiple RDBMSs.
 *
 * Known issues:
 *
 * It is still possible to get to the controller/action without valid parameters.
 * This can happen when the request route is the controller/action directly.
 * The action should always validate the parameters.
 *
 * EDbUrlRule::parseUrl is a copy of Yii framework's CUrlRule::parseUrl
 * with a few new lines of code. This method may lag behind the framework's
 * enhancements. You're advised to check for updates on this extension or update
 * the code by yourself upon framework updates.
 */

/**
 * EDbUrlManager provides dynamic database-based URL rules.
 *
 * These dynamic rules are like Wordpress' "pretty permalinks" or "friendly URLs".
 * You do not have to have the controller name (or ID) on the URL: this extension
 * can handle the request URI and route it to the correct controller.
 *
 * Installation: place the extension directory "DbUrlManager" under
 * the directory protected/extensions in your application.
 * Follow the instructions below to configure your application to use the extension.
 *
 * You should use EDbUrlManager with 'format'=>'path' or it will not work.
 *
 * Setup the extension like this on your configuration file:
 * <pre>
 * 'urlManager'=>array(
 *     'class'=>'ext.DbUrlManager.EDbUrlManager',
 *     'urlFormat'=>'path',
 *     'connectionID'=>'db',
 *     ...
 * </pre>
 *
 * The properties in the example above:
 * <ul>
 * <li>class: specifies the extension class.</li>
 * <li>urlFormat: this extension must be used with urlFormat set to 'path'.</li>
 * <li>connectionID: the ID of CDbConnection application component.</li>
 * </ul>
 *
 * The dynamic rules must be specified using the array format, like the example below:
 * <pre>
 * 'rules'=>array(
 *     // A dynamic rule.
 *     '<author:\w+>/<post:\w+>'=>array(
 *         'post/view',
 *         'type'=>'db',
 *         'fields'=>array(
 *             'author'=>array(
 *                 'table'=>'tbl_author',
 *                 'field'=>'author_name'
 *             ),
 *             'post'=>array(
 *                 'table'=>'tbl_post',
 *                 'field'=>'post_slug'
 *             ),
 *         ),
 *     ),
 *     // Now additional standard rules.
 *     '<controller:\w+>/<id:\d+>'=>'<controller>/view',
 *     '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
 *     '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
 * ),
 * </pre>
 *
 * You can have as many 'db' rules as you wish, in any position of the 'rules' array.
 * Notice that the position determines the rule priority. If the 'db' rule of the
 * example was below of the third standard rule, it would be never reached because
 * the regex patterns are the same.
 *
 * The rule named parameters (in the example above 'author' and 'post') are linked
 * to a table and a field via the 'fields' property.
 *
 * The new rule properties are:
 * <ul>
 * <li>type: specifies the type of the rule. Use 'db' for dynamic rules. Standard
 * rules doesn't need this property to be set.</li>
 * <li>fields: the table and the field related to the rule parameter.</li>
 * </ul>
 *
 * How it works (using the rule of the example above): in a request URI like
 * "john/my-first-post", the extension will check if there is a user called
 * "john" and a post slug "my-first-post". If there are, the route used
 * will be the one specified in the rule: post/view.
 * If not, it will ignore the current rule and try to match the next one.
 *
 * The dynamic rules can also be used for creating URLs, just like a
 * standard rule. It is transparent and does not need any setup, just call:
 * <pre>
 * Yii::app()->createUrl('post/view',array('author'=>'john','post'=>'my-first-post'));
 * </pre>
 * This is similar to and works with CHtml::link.
 * Notice that the values specified for the parameters are not checked on the database.
 *
 * EDbUrlManager may be accessed via {@link CWebApplication::getUrlManager()}.
 *
 * Performance tips:
 * <ul>
 * <li>Each parameter on each dynamic rule means one database query. Do not specify
 * more parameters than the needed to identify the controller.</li>
 * <li>You can specify standard rules above the dynamic rules. You can specify the
 * name (ID) of the controller in the standard rule instead of a regex pattern if
 * the regex patterns of the rules would be the same. This avoids unecessary queries.</li>
 * <li>Remember to use an index on the database fields used in dynamic rules.</li>
 * </ul>
 *
 * @author Rodrigo Coelho <ext.dev@contas.rodrigocoelho.com.br>
 * @copyright Copyright &copy; 2010 Rodrigo Coelho
 * @license http://www.yiiframework.com/license/ Yii Framework License
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @package ext.DbUrlManager
 */
class UrlManager extends \yii\web\UrlManager {

    /**
     * @var string the ID of CDbConnection application component.
     * Defaults to 'db' which refers to the primary database application component.
     */
    public $connectionID = 'db';
    /**
     * @var CDbConnection the DB connection instance.
     */
    private $_db;

    /**
     * @return CDbConnection the DB connection instance
     * @throws CException if {@link connectionID} does not point to a valid application component.
     * @since 1.0
     */
    public function getDbConnection() {
        if ($this->_db !== null)
            return $this->_db;
        else if (($id = $this->connectionID) !== null) {

            if (($this->_db = Yii::$app->{$id}) instanceof yii\db\Connection)
                return $this->_db;
        }
        throw new CException(Yii::t('DbUrlManager', 'wbp\UrlManager.connectionID "{id}" does not point to a valid DbConnection application component.',
            array('{id}' => $id)));
    }

    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){
            //Если указан идентификатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию
            $lang = Languages::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Lang::getDefaultLang();

            }
            unset($params['lang_id']);
            $lang = $lang->lang_full_key;
        } else {
            //Если не указан параметр языка, то работаем с текущим языком
            $lang = Yii::$app->lang->getCurrent();
        }

        //Получаем сформированный URL(без префикса идентификатора языка)
        $url = parent::createUrl($params);

        //Добавляем к URL префикс - буквенный идентификатор языка

        $langUrlPrefix=Yii::$app->lang->languagesUrls[$lang];


        if($langUrlPrefix=='') return $url;

        if( $url == '/' ){
            return '/'.$langUrlPrefix;
        }else{
            return '/'.$langUrlPrefix.$url;
        }
    }

}

