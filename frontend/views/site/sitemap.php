
<div class="gray-line content-line-padding">
    <div class="container">

        <div class="text-uppercase h2-like">Карта сайта</div>

        <a href="/" class="site-map-main-page">Главная страница</a>
        <?=\yii\widgets\Menu::widget([
            'items'=>$allItems,
            'options'=>[
                'class'=>'site-map'
            ],
            'encodeLabels'=>false,

        ]);
        ?>
    </div>
</div>