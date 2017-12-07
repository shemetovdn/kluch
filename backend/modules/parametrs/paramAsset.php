<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\modules\parametrs;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

class paramAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/parametrs/source';
    public $css = [
//        'css/ng-sortable.css',
//        'css/ng-sortable.style.css',
    ];
    public $js = [
        'js/angular.js',
        'js/angular-route.min.js',
        'js/param.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
//        'yii\jui\JuiAsset'
    ];

    public static function register($view) {
        $bundle=parent::register($view);
        $js = "
            var basePath = '".$bundle->baseUrl."/';
            var primaryColor = '#e25f39',
                dangerColor = '#bd362f',
                successColor = '#609450',
                warningColor = '#ab7a4b',
                inverseColor = '#45484d';
            var themerPrimaryColor = primaryColor;

        ";
        $view->registerJs($js, \yii\web\View::POS_END);

        return $bundle;
    }
}
