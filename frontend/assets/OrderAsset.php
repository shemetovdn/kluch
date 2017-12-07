<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class OrderAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/files';

    public $js = [
        'js/modernizr.custom.js',
        'js/classie.js',
        'js/selectFx.js',
        'js/fullscreenForm.js',
    ];

    public $css = [
        'css/FullscreenForm/normalize.css',
        'css/FullscreenForm/demo.css',
        'css/FullscreenForm/component.css',
        'css/FullscreenForm/cs-select.css',
        'css/jquery-ui.min.css',
        'css/bootstrap.min.css',
        'css/style.css',
        'css/responsive.css',
        'css/font-awesome.min.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'wbp\assets\BootstrapAsset',  // with bootbox
    ];
}
