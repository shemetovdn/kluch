<?php

namespace wbp\fileUploader;

use wbp\uploadifive\Uploadifive;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * Uploadify Widget
 *
 */
class fileUploader extends Widget {

    public $style='';
    public $data=[];
    public $type='';
    public $item_id=0;
    public $limit=1000;
    public $uniqueId;

    public function run(){
        $this->uniqueId=uniqid('FileUploader_');

        $loaderFunction="function(){ reload_".$this->uniqueId."(); }";

        $function="
            function reload_".$this->uniqueId."() {
                        $.ajax({
                            url:'".Url::to(['getFile'])."',
                            data:{
                                'type':'".$this->type."',
                                'uniqueId':'".$this->uniqueId."',
                                'item_id':'".$this->item_id."',
                                'limit':'".$this->limit."',
                                'data':'".json_encode($this->data)."',
                                'tmp':true
                            },
                            type:'POST',
                            success:function(data){
                                $('#".$this->uniqueId."-files').html(data);
                            }
                        })
//                console.log('test');
            }
        ";

        $this->view->registerJs($function, View::POS_END);

        $return=Html::hiddenInput('file[]', $this->uniqueId);
        $return .=
            Uploadifive::widget([
                'url' => Url::to(['uploadFile']),
                'id' => $this->uniqueId,
                'style' => $this->style,
                'data' => $this->data,
                'csrf' => true,
                'jsOptions' => [
                    'width' => 'auto',
                    'height' => 'auto',
                    'buttonText' => '',
                    'formData' => ['type'=>$this->type, 'uniqueId'=>$this->uniqueId, 'item_id'=>$this->item_id, 'limit'=>$this->limit],
                    //'auto'=>false,
                    'onError' => "function(file, errorCode, errorMsg, errorString) {
                        console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
                    }",
                    'onInit' => $loaderFunction,
                    'onUploadComplete' => $loaderFunction,
                ]
            ]);
        return $return;

    }

}
