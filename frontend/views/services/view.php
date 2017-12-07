<?php
use frontend\widgets\orderWidget\OrderWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$bundle=\frontend\assets\AppAsset::register($this);

?>

<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<section>
    <div class="custom-page inner-page">

        <div class="inner-banner" style="background-image: url('<?=$services->image->getUrl()?>'); position: relative;">

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


                    <div class="hidden-xs col-sm-12 breadcrumbs">
                        <a href="<?=Url::to(['site/index'])?>">Главная</a> —
                        <span><?=$services->title?></span>
                    </div>

                </div>
            </div>

            <div class="banner-title-box">
                <div class="title">
                    <?=$services->title?>
                </div>
            </div>

        </div>

        <div class="content">
            <div class="container">
                <div class="from-admin-panel">
                    <?=$services->description?>
                </div>
            </div>
        </div>

        <?=OrderWidget::widget()?>

    </div>

</section>

