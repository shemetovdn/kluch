<?
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'item-advart',
    'options' => [
        'tag' => 'div',
        'class' => 'related-nearby-carousel my-carousel',
        'id' => '',
    ],
    'itemOptions'=>[
        'tag'=>'div',
        'class'=>'carousel-item',
    ],
    'summary' => false,
]);
?>

