<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\customRadioCheck;

use yii\web\AssetBundle;


/**
 * This asset bundle provides ajaxer function (usind <a> tag as ajax link)
 *
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class CustomRadioCheckAsset extends AssetBundle
{
    public $sourcePath = '@wbp/customRadioCheck/files';
    public $js = [
        'customRadioCheck.js',
    ];
    public $css = [
        'customRadioCheck.css',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function register($view) {
        $js = "$('input[type=checkbox], input[type=radio]').customRadioCheck();";
        $view->registerJs($js, \yii\web\View::POS_END);

        return parent::register($view);
    }

}
