<?php

use yii\helpers\Html;
use yii\helpers\Url;

$uCKid = uniqid('ck_');
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
                <?
                $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'form-' . $uCKid,
                    'action' => Url::to(['create-answer']),

                ]);
                ?>
                <div class="modal-body">
                    <table class="table">
                        <? if ($model->fname != ''){?>
                            <tr>
                                <td class="col-md-2" style="border-top: none;"><b>Имя</b>:</td>
                                <td class="col-md-offset-3 col-md-3" style="border-top: none;"><?= Html::encode($model->fname)?></td>
                            </tr>
                        <?}?>
                        <? if ($model->phone != ''){?>
                            <tr>
                                <td class="col-md-2"><b>Телефон</b>:</td>
                                <td class="col-md-offset-3 col-md-3"><?= Html::encode($model->phone)?></td>
                            </tr>
                        <?}?>
                        <? if (!empty($model->property_id)){?>
                            <tr>
                                <td class="col-md-2"><b>Объвление</b>:</td>
                                <td class="col-md-offset-3 col-md-3"><a href="<?=Url::to(['/adverts/edit?id='.$model->property_id])?>"><?= Url::to(['/adverts/edit?id='.$model->property_id])?></a></td>
                            </tr>
                        <?}?>
                        <? if ($model->message != ''){?>
                            <tr>
                                <td class="col-md-2"><b>Сообщение</b>:</td>
                                <td class="col-md-offset-3 col-md-7" colspan="3">
                                    <div style="overflow-y: auto; max-height: 200px;">
                                        <?= Html::encode($model->message) ?>
                                    </div>
                                </td>
                            </tr>
                        <?}?>
                    </table>
                </div>

                <div class="modal-footer">
                    <?
                        echo \yii\helpers\Html::Button('Закрыть', ['class' => 'btn btn-default', 'onclick' => 'uniqueOverlay.close();']);
                    ?>
                </div>
                <?
                \yii\widgets\ActiveForm::end();
                ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php
echo \wbp\uniqueOverlay\UniqueOverlay::script();