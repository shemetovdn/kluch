<?php
    use yii\widgets\ListView;
    use yii\helpers\Url;
    $bundle=\frontend\assets\AppAsset::register($this);
?>

<?//=$model->image->getUrl()?>


<section>
    <div class="custom-page catalog-item">

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




            <div class="breadcrumbs">
                <a href="<?=Url::to(['site/index'])?>">Главная</a> <span>—</span>
                <span>Новости</span>
            </div>

            <div class="page-name">
                Новости Крыма и Феодосии
            </div>

            <div class="catalog">
            <?
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'news-item',
                    'summary' => false,
                    'itemOptions' => [
                        'class' => 'col-sm-6 col-md-4'
                    ],

                    'layout' => "<div class='row'>{items}</div>{summary}<div class='catalog-pagination'>\n{pager}</div>",

                    'pager' => [
                        'firstPageLabel' => 'first',
                        'lastPageLabel' => 'last',
                        'prevPageLabel' => 'previous',
                        'nextPageLabel' => 'next',
                        'class'=>'\frontend\models\LinkPager',

                        // Customzing options for pager container tag
                        'options' => [],
                    ],

                ])
            ?>
            </div>

            <div style="clear: both; height: 100px;"></div>

        </div>
    </div>

</section>

