<?php
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use backend\modules\adverts\models\ObjectTypes;
use backend\modules\regions\models\Regions;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$bundle = \frontend\assets\ImageAsset::register($this);
$objectTypesArray = ObjectTypes::getList('id', 'title', 'title');
$regions = Regions::getList('id', 'title', 'title');
?>

<section>
    <div class="custom-page variant-page">

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
                <span>Заявка на продажу недвижимости</span>
            </div>

            <div class="page-name">
                Заявка на продажу
            </div>

            <div class="describe-your-variant">
                Оставьте заявку и мы свяжемся с Вами.
            </div>


            <!-- MY-->
            <div class="dv-form-page form-container">
                <? $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'],]); ?>
                <?= $form->field($request, 'type')->hiddenInput(['value'=>'1'])->label(false)?>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Тип недвижимости</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeDropDownList($request, 'property_type', ArrayHelper::merge(['Тип недвижимости'], $objectTypesArray), ['class'=>'nselect'])?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Количество комнат</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextInput($request, 'rooms')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Цена</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextInput($request, 'price')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Расположение</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeDropDownList($request, 'place', ArrayHelper::merge(['Расположение'], $regions), ['class'=>'nselect'])?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Примечание</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextarea($request, 'message')?>
                    </div>
                </div>

                <div class="form-group-sep-line"></div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Ваше имя</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextInput($request, 'fname')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Телефон</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextInput($request, 'phone')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">E-mail</label>
                    <div class="col-sm-8 right-column">
                        <?=Html::activeTextInput($request, 'email')?>
                    </div>
                </div>

                <div class="form-group-sep-line"></div>

                <div class="form-submit">
                    <?=Html::button('Отправить', ['class'=>'button--isi button btn-radius', 'type'=>'submit'])?>
                </div>

                <? ActiveForm::end(); ?>
            </div>
            <!-- MY END-->

        </div>
    </div>

</section>
