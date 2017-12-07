<?php


$id=uniqid('cropper_');

$this->registerJs('centeruniqueOverlay();',\yii\web\View::POS_END);

echo \wbp\cropper\Cropper::widget([
    'id' => $id,
    'modal' => false,
    'cropUrl' => \yii\helpers\Url::to(['crop-image']),
    'removeUrl' => \yii\helpers\Url::to(['remove-image']),
    'image' => $image,
    'aspectRatio' => $size->aspect_ratio, // or 16/9(wide) or 1/1(square) or any other ratio. Null - free ratio
    'options' => [],
    'pluginOptions'=>[
        'data'=>$data,
        'built'=>new yii\web\JsExpression(<<<JS
            function() {
                centeruniqueOverlay();
            }
JS
        ),
    ],
    'imageOptions' => [],
    'external_options' => ['type'=>$type,'itemId'=>$itemId,'imageId'=>$imageId,'id'=>$size->id],
    'ajaxOptions' => [
        'success' => new yii\web\JsExpression(<<<JS
            function(data) {
                hideAjaxerMask();
                var fn = window['success_$croper_widget_id'];
                if(typeof fn === 'function') {
                    fn(data);
                }
            }
JS
        ),
    ],
]);