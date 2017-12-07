<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\chosen;

use yii\web\AssetBundle;


/**
 * This asset bundle provides ajaxer function (usind <a> tag as ajax link)
 *
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class ChosenAsset extends AssetBundle
{
    public $sourcePath = '@wbp/chosen/files';
    public $js = [
        'chosen.jquery.js',
    ];
    public $css = [
        'chosen.min.css',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function register($view) {
        $js = "
            $('.chosen.simple').chosen({disable_search_threshold: 1000});
            $('.chosen').chosen();
        ";
        $view->registerJs($js, \yii\web\View::POS_END);

        return parent::register($view);
    }

}
