<?php
/**
 * Created by PhpStorm.
 * User: Леха
 * Date: 10.05.2016
 * Time: 12:28
 */

namespace wbp\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-theme.min.css',
    ];
    
    public $js = [
        'js/bootstrap.min.js',
        'js/bootbox.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];
}