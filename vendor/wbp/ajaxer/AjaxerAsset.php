<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\ajaxer;

use yii\web\AssetBundle;


/**
 * This asset bundle provides ajaxer function (usind <a> tag as ajax link)
 *
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class AjaxerAsset extends AssetBundle
{
    public $sourcePath = '@wbp/ajaxer/files';
    public $js = [
        'js/materialize.min.js',
        'ajaxer.js'
    ];
    public $css=[
        'css/materialize.css'
    ];

    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
