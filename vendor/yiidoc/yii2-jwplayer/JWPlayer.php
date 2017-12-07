<?php
namespace yii\jwplayer;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

class JWPlayer extends Widget
{
    public $key = ''; //N8zhkmYvvRwOhz4aTGkySoEri4x+9pQwR7GHIQ==
    public $options = [];
    public $clientOptions = [];

    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->defaultOptions();
        $this->registerAssetBundle();
        $this->registerJs();
    }

    public function defaultOptions()
    {
        $this->clientOptions['width'] = ArrayHelper::getValue($this->clientOptions, 'width', '100%');
        $this->clientOptions['skin'] = ArrayHelper::getValue($this->clientOptions, 'skin', 'five');
        if(!isset($this->clientOptions['height'])){
            $this->clientOptions['aspectratio']='16:9';
        }
        if (!isset($this->clientOptions['sharing']['link'])) {
            $this->clientOptions['sharing']['link'] = Yii::$app->request->absoluteUrl;
        }
        $this->clientOptions['abouttext'] = ArrayHelper::getValue($this->clientOptions, 'abouttext', Yii::$app->name);
        $this->clientOptions['aboutlink'] = ArrayHelper::getValue($this->clientOptions, 'aboutlink', Yii::$app->request->hostInfo);
    }

    public function run()
    {
        echo Html::tag('div', '', $this->options);
    }

    public function registerAssetBundle()
    {
        JWPlayerAsset::register($this->getView());
    }

    public function registerJs()
    {
        $this->getView()->registerJs("jwplayer.key='{$this->key}';", View::POS_READY, 'jwplayer.key');
        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("jwplayer('{$this->options['id']}').setup({$options});");
    }
} 