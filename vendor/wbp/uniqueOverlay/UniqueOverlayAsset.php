<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\uniqueOverlay;

use yii\web\AssetBundle;


/**
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class UniqueOverlayAsset extends AssetBundle
{
    public $sourcePath = '@wbp/uniqueOverlay/files';
    public $js = [
        'UniqueLightBox.js',
    ];
    public $css = [
        'style.css'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'wbp\ajaxer\AjaxerAsset',
        'wbp\jqueryTools\JqueryTools',
    ];

}
