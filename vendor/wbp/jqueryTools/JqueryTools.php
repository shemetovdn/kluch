<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\jqueryTools;

use yii\web\AssetBundle;


/**
 * This asset bundle provides ajaxer function (usind <a> tag as ajax link)
 *
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class JqueryTools extends AssetBundle
{
    public $sourcePath = '@wbp/jqueryTools/files';
    public $js = [
        'jquery.tools.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
