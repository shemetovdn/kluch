<?
use yii\widgets\ListView;
use yii\helpers\Url;
use frontend\widgets\filterWidget\FilterWidget;
$bundle = \frontend\assets\ImageAsset::register($this);

$this->registerJs("
    $('.dv_services_item img.img_box').hover(
        function() {
            $(this).parents('.dv_services_item').find('.ser-title a').addClass('hover');
        }, function() {
            $(this).parents('.dv_services_item').find('.ser-title a').removeClass('hover');
        }
    );
", yii\web\View::POS_READY);

?>


<section>
    <div class="custom-page partners-page">

        <div class="container">

            <div class="row">
                <div class="filters-block">

                    <div id="filtersCall" class="filtersCall closed hidden-md hidden-lg">
                        <span class="filter-logo"><img src="<?=$bundle->baseUrl?>/images/svg-png/search-blue.png" alt=""></span>
                        Искать недвижимость
                        <span class="filter-caret"><img src="<?=$bundle->baseUrl?>/images/svg-png/arrowdown.png" alt=""></span>
                    </div>

                    <div class="filter-wrapper">

                        <?= \frontend\widgets\otherFilterWidget\OtherFilterWidget::widget()?>
                    </div>
                </div>
            </div>

            <div class="hidden-xs breadcrumbs">
                <a href="<?=Url::to(['site/index'])?>">Главная</a> —
                <span>Услуги</span>
            </div>

            <div class="page-name">
                Услуги
            </div>

            <?
                echo ListView::widget([
                    'dataProvider'  =>  $dataProvider,
                    'itemView'      =>  'services-item',
                    'summary'       =>  false,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row services',
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-xs-12 col-sm-4 col-md-3 column'
                    ]
                ]);
            ?>

            <div class="dv_services_hide-sep-line"></div>

        </div>
    </div>

</section>