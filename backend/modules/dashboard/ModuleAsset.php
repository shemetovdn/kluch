<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\modules\dashboard;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ModuleAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@backend/modules/dashboard/assets/files';
    public $css = [
//        'css/admin.css',
    ];
    public $js = [
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}