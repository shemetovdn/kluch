<?
    use yii\widgets\ListView;
    use yii\helpers\Url;
    use frontend\widgets\filterWidget\FilterWidget;
$bundle = \frontend\assets\ImageAsset::register($this);
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
                <span>Партнёры</span>
            </div>

            <div class="page-name">
                Партнёры
            </div>

            <div class="row">

                <div class="col-md-9 partners-list">

                    <?
                        echo ListView::widget([
                            'dataProvider'  =>  $dataProvider,
                            'itemView'      =>  '_partners_item',
                            'summary'       =>  false,
                            'options' => [
                                'tag' => 'div',
                                'class' => 'row',
                            ],
                            'itemOptions' => [
                                'tag' => 'div',
                                'class' => 'col-xs-6 col-sm-4 partners-item'
                            ]
                        ]);
                    ?>

                </div>

                <div class="col-md-3 partners-side-bar">

                    <?=$model->contents[0]->content?>

                </div>

            </div>
        </div>
    </div>

</section>