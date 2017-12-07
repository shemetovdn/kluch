<?php

namespace wbp\uploadifive;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Sortable;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\widgets\InputWidget;
use wbp\uploadifive\UploadifiveAsset;

/**
 * Uploadify Widget
 *
 */
class Uploadifive extends InputWidget {

    /**
     * upload file to URL
     * @var string 
     * @example
     * http://xxxxx/upload.php
     * ['article/upload']
     * ['upload']
     */
    public $style;
    public $data;

    public $url;

    /**
     * enable csrf verify
     * @var bool 
     */
    public $csrf = true;

    /**
     * 是否渲染Tag
     * @var bool
     */
    public $renderTag = true;

    /**
     * uploadify js options
     * @var array
     * @example 
     * [
     * 'height' => 30,
     * 'width' => 120,
     * 'uploadScript' => '/uploadify/uploadify.php',
     * ]
     * @see http://www.uploadify.com/documentation/
     */
    public $jsOptions = [];

    public $layout="{containerStart}\n{input}\n{files}\n{containerEnd}";
    
    /**
     * uploadify javascript event list
     * @var []
     * @see http://www.uploadify.com/documentation/
     */
    public $events = [
        'onCancel', 'onClearQueue', 'onDestroy', 'onDialogClose', 'onDialogOpen',
        'onDisable', 'onEnable', 'onFallback', 'onInit', 'onQueueComplete',
        'onSelect', 'onSelectError', 'onSWFReady', 'onUploadComplete',
        'onUploadError', 'onError', 'onUploadProgress', 'onUploadStart', 'onUploadSuccess',
    ];

    /**
     * Initializes the widget.
     */
    public function init() {
        //init var
        if (empty($this->url)) {
            $this->url = \yii\helpers\Url::to('index');
        }
        if (empty($this->id)) {
            $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        }
        $this->options['id'] = $this->id;
        if (empty($this->name)) {
            $this->name = $this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->id;
        }

        //register js css

        if($this->style) UploadifiveAsset::$uploadifyStyle=$this->style;
        $assets = UploadifiveAsset::register($this->view);

        //init options
        $this->initUploadifyOptions($assets);

        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerScripts();
        if ($this->renderTag === true) {
            echo $this->renderTag();
        }
    }

    /**
     * init Uploadify options
     * @param [] $assets
     * @return void
     */
    private function initUploadifyOptions($assets) {
        $baseUrl = $assets->baseUrl;

        $this->jsOptions['uploadScript'] = $this->url;
//        $this->jsOptions['swf'] = $baseUrl . '/uploadify.swf';

        //csrf options
        if ($this->csrf) {
            $this->initUploadifyCsrfOption($this->jsOptions);
        }

        /**
         * JsExpression convert
         */
        foreach ($this->jsOptions as $key => $val) {
            if (in_array($key, $this->events) && !($val instanceof JsExpression)) {
                $this->jsOptions[$key] = new JsExpression($val);
            }
        }
    }

    /**
     * uploadify csrf options
     * 
     * @param type $jsOptions
     * @return void
     */
    private function initUploadifyCsrfOption(&$jsOptions) {
        $session = Yii::$app->session;
        $session->open();
        $sessionIdName = $session->getName();
        $sessionIdValue = $session->getId();

        $request = Yii::$app->request;
        $csrfName = $request->csrfParam;
        $csrfValue = $request->getCsrfToken();
        $session->set($csrfName, $csrfValue);

        $jsOptions['formData'][$sessionIdName] = $sessionIdValue;
        $jsOptions['formData'][$csrfName] = $csrfValue;

    }

    /**
     * render file input tag
     * @return string
     */
    private function renderTag() {

        $result=str_replace([
            '{containerStart}',
            '{input}',
            '{files}',
            '{containerEnd}',
            '{queue}'
        ],[
            Html::beginTag('div',['id'=>$this->id.'-container','class'=>'uploadifive-container']),
            Html::fileInput($this->name, null, $this->options),
            $this->generateFiles(),
            Html::endTag('div'),
            Html::tag('div','',['id'=>'uploadifive-'.$this->id.'-queue','class'=>'uploadifive-queue']),
        ],$this->layout);

        $result = Html::tag("div",$result,['class'=>"UplodifyImageUploaderWithSortable"]);

        return $result;
    }

    private function generateFiles(){
//        $result = Html::tag('div','',['id'=>$this->id.'-files','class'=>'uploadifive-files']);
        return Sortable::widget([
            'options' => ['id' => $this->id.'-files','tag'=>'div','class'=>'uploadifive-files'],
            'clientOptions' => ['cursor' => 'move', 'items' => '.image'],
            'clientEvents' => [
                'update' => "function(event, ui){
                    $.post(
                        '" . Url::to(['sort-image']) . "',
                        {elements:$(this).sortable('toArray',{attribute:'data-key'})}
                    );
                }"
            ]
        ]);
    }

    /**
     * register script
     */
    private function registerScripts() {

        if(strpos($this->layout,'{queue}')!==false){
            $this->jsOptions['queueID'] = 'uploadifive-'.$this->id.'-queue';
        }

        $jsonOptions = Json::encode($this->jsOptions);
        $script = <<<EOF
$('#{$this->id}').uploadifive({$jsonOptions});
EOF;

        $this->view->registerJs($script, View::POS_READY);
    }

}
