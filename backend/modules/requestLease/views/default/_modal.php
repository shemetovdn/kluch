<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 01.03.2016
 **** Time: 12:00
 */
use yii\helpers\Html;
use yii\helpers\Url;

use backend\modules\adverts\models\ObjectTypes;
use backend\modules\regions\models\Regions;

$rent_sale = 'Купить';
if ($model->rent_sale == 1) $rent_sale = 'Арендовать';

$rent_type = 'Краткосрочная';
if ($model->rent_type == 1) $rent_type = 'Долгосрочная';

?>

    <div class="" id="myModal" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true"
                            onclick="uniqueOverlay.close();">×
                    </button>
                    <h4 class="modal-title">Сообщение # <?= $model->id ?> ( <?=Yii::$app->formatter->asDatetime($model->created_at)?> )</h4>
                </div>

                <div class="modal-body">
                    <table class="table">


                            <tr>
                        <? if ($model->fname != ''){?>
                                <td class="col-md-2" style="border-top: none;"><b>Имя</b>:</td>
                                <td class="col-md-offset-1 col-md-3" style="border-top: none;"><?= Html::encode($model->fname)?></td>
                        <?}?>


                        <? if ($model->phone != ''){?>
                                <td class="col-md-2"><b>Телефон</b>:</td>
                                <td class="col-md-offset-1 col-md-3"><?= Html::encode($model->phone)?></td>
                        <?}?>
                            </tr>
                            <tr>
                        <? if ($model->email != ''){?>
                                <td class="col-md-2"><b>Email</b>:</td>
                                <td class="col-md-offset-1 col-md-3"><?= Html::encode($model->email) ?></td>
                        <?}?>

                        <? if ($model->type == 2){?>
                                <td class="col-md-2"><b>Что хотите?</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <?=Html::encode($rent_sale)?>
                                </td>
                        <?}?>
                            </tr>

                            <tr>
                        <? if ($model->type == 2){?>
                                <td class="col-md-2"><b>Тип аренды</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <?=Html::encode($rent_type)?>
                                </td>
                        <?}?>

                        <? if ($model->property_type != 0){?>
                                <td class="col-md-2"><b>Тип недвижимости</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <?= Html::encode(ObjectTypes::findById($model->property_type)->title) ?>
                                </td>
                        <?}?>
                            </tr>

                            <tr>
                        <? if ($model->place != 0){?>
                                <td class="col-md-2"><b>Расположение</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <?= Html::encode(Regions::findById($model->place)->title) ?>
                                </td>
                        <?}?>

                        <? if ($model->price){?>
                                <td class="col-md-2"><b>Цена</b>:</td>
                                <td class="col-md-offset-1 col-md-3"><?= Html::encode($model->price)?></td>
                        <?}?>
                            </tr>

                            <tr>
                        <? if ($model->price_from || $model->price_to){?>
                                <td class="col-md-2"><b>Цена</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <? if ($model->price_from) echo 'от '.Html::encode($model->price_from).' '?>
                                    <? if ($model->price_to) echo 'до '.Html::encode($model->price_to)?>
                                </td>
                        <?}?>

                        <? if ($model->rooms){?>
                                <td class="col-md-2"><b>Количество комнат</b>:</td>
                                <td class="col-md-offset-1 col-md-3"><?= Html::encode($model->rooms)?></td>
                        <?}?>
                            </tr>

                            <tr>
                        <? if ($model->rooms_from || $model->rooms_to){?>
                                <td class="col-md-2"><b>Количество комнат</b>:</td>
                                <td class="col-md-offset-1 col-md-3">
                                    <? if ($model->rooms_from) echo 'от '.Html::encode($model->rooms_from).' '?>
                                    <? if ($model->rooms_to) echo 'до '.Html::encode($model->rooms_to)?>
                                </td>
                            </tr>
                        <?}?>

                        <tr>
                        <? if ($model->message != ''){?>
                                <td class="col-md-2"><b>Сообщение</b>:</td>
                                <td class="col-md-offset-1 col-md-7" colspan="3">
                                    <div style="overflow-y: auto; max-height: 200px;">
                                        <?= Html::encode($model->message) ?>
                                    </div>
                                </td>
                        <?}?>
                            </tr>

                    </table>
                </div>

                <div class="modal-footer">
                    <?
                        echo \yii\helpers\Html::Button('Закрыть', ['class' => 'btn btn-default', 'onclick' => 'uniqueOverlay.close();']);
                    ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php
echo \wbp\uniqueOverlay\UniqueOverlay::script();