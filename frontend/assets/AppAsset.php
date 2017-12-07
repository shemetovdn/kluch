<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/files';

    public $js = [
//        '//html5shiv.googlecode.com/svn/trunk/html5.js',
        'js/owl.carousel.js',
        'js/nselect-master/build/jquery.nselect.js',
        'js/multiple-select-master/multiple-select.js',
        'js/fotorama/fotorama.js',
        'js/inputMask.js',
        'js/scripts.js',
        'js/filter.js',
        'dev.js',
    ];

    public $css = [
        'css/owl.carousel.css',
        'js/fotorama/fotorama.css',
        'fonts/font-awesome/css/font-awesome.min.css',
        'js/nselect-master/build/jquery.nselect.css',
        'js/multiple-select-master/multiple-select.css',
        'css/style.css',
        'css/header.css',
        'css/footer.css',
        'dev.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'wbp\assets\BootstrapAsset',  // with bootbox
    ];
}
