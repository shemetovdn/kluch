<?php
$this->registerJs('
            var owl = $(\'.owl-carousel\');
            owl.owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                items: 1,
            })
', \yii\web\View::POS_END);

    echo \yii\widgets\ListView::widget([
        'dataProvider'=>$exclusive,
        'options'=>[
            'class'=>'exclusive-sale-carousel my-carousel',
        ],
        'itemOptions'=>[
            'tag'=>'div',
            'class'=>'carousel-item',
        ],
        'itemView'=>'index-exclusive-item',
        'layout'=>"{items}"
    ])
?>
