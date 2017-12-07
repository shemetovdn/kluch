<?php
use backend\modules\management\models\Management;
use frontend\assets\ImageAsset;
use frontend\widgets\orderWidget\OrderWidget;

use frontend\widgets\callbackWidget\CallbackWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = $model->title;
$bundle = ImageAsset::register($this);
?>

<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<section>
    <div class="custom-page inner-page">

        <div class="inner-banner" style="background-image: url('<?=$bundle->baseUrl?>/images/upravlenie_02.png')">

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
                        <a href="<?=Url::to(['site/index'])?>">Главная</a> — <span>Управление недвижимостью</span>
                    </div>

                    <div class="banner-title-box">
                        <div class="title">
                            Управление недвижимостью
                        </div>
                    </div>

                </div>

            </div>



        </div>

        <div class="options">
            <div class="container">

                <?php

                    echo \yii\widgets\ListView::widget([
                        'dataProvider'=>$propertys,
                        'options'=>[
                            'tag'=>'div',
                            'class'=>'row',
                        ],
                        'itemOptions'=>[
                            'tag'=>'div',
                            'class'=>'col-md-4 option-item',
                        ],
                        'itemView'=>'item',
                        'summary'=> false,
                    ])
                ?>

            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row col-xs-12 from-admin-panel">

                    <?=$model->description?>

                </div>
            </div>
        </div>

        <?=OrderWidget::widget()?>

    </div>

</section>


