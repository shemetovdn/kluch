<?php

namespace wbp\uploadifive;

use yii\web\AssetBundle;

class UploadifiveAsset extends AssetBundle {

    public static $uploadifyStyle='';

    public $sourcePath;
    public $basePath = '@webroot/assets';
//    public $publishOptions = ['forceCopy' => YII_DEBUG];
    public $css = ['uploadifive.css'];
    public $js = [];
    public $depends = ['yii\web\JqueryAsset'];

    private function getJs() {
        return [
            'jquery.uploadifive.min.js',
        ];
    }

    public function init() {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        if (empty($this->js)) {
            $this->js = $this->getJs();
        }
        if(UploadifiveAsset::$uploadifyStyle){
            $this->css[]=UploadifiveAsset::$uploadifyStyle.'.css';
        }

        return parent::init();
    }

}
