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
                <span>Не могу найти свой вариант</span>
            </div>

            <div class="page-name">
                Не могу найти свой вариант
            </div>

            <div class="describe-your-variant">
                Опишите желаемый вариант, мы свяжемся с Вами
                и предложим подходящие варианты
            </div>


            <!-- MY-->
            <div class="dv-form-page form-container">
                <? $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'],]); ?>
                    <?= $form->field($request, 'type')->hiddenInput(['value'=>'2'])->label(false)?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Что хотите?</label>
                        <div class="col-sm-8 right-column">
                            <div class="radio-block">
                                <input type="radio" id="what_want_1" name="Request[rent_sale]" value="0" />
                                <label for="what_want_1"><span>Купить</span></label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="what_want_2" name="Request[rent_sale]" value="1" checked/>
                                <label for="what_want_2"><span>Арендовать</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Тип аренды</label>
                        <div class="col-sm-8 right-column">
                            <div class="radio-block">
                                <input type="radio" id="lease_type_1" name="Request[rent_type]" value="0" />
                                <label for="lease_type_1"><span>Краткосрочная</span></label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="lease_type_2" name="Request[rent_type]" value="1" checked/>
                                <label for="lease_type_2"><span>Долгосрочная</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Тип недвижимости</label>
                        <div class="col-sm-8 right-column">
                            <?=Html::activeDropDownList($request, 'property_type', ArrayHelper::merge(['Тип недвижимости'], $objectTypesArray), ['class'=>'nselect'])?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Количество комнат</label>
                        <div class="col-sm-8 right-column">
                            <?=Html::activeTextInput($request, 'rooms_from', ['placeholder'=>'от', 'class'=>'room-num'])?>
                            <span class="from-to-separ">—</span>
                            <?=Html::activeTextInput($request, 'rooms_to', ['placeholder'=>'до', 'class'=>'room-num'])?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Цена</label>
                        <div class="col-sm-8 right-column">
                            <?=Html::activeTextInput($request, 'price_from', ['placeholder'=>'от', 'class'=>'price-num'])?>
                            <span class="from-to-separ">—</span>
                            <?=Html::activeTextInput($request, 'price_to', ['placeholder'=>'до', 'class'=>'price-num'])?>
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
