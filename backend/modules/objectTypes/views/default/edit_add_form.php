
<? $form=\yii\bootstrap\ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "<div class=\"col-md-3\">\n{label}\n</div>\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'form-control-label',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-md-9',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>

<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-bottom-50">
                <h4>Параметр</h4>
                <br />
                <?=$form->field($formModel, 'id')->hiddenInput()->label(false)?>


                <?=$form
                    ->field($formModel,'title',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите заголовок...'])->label(Yii::t('admin','Title'))
                ?>

                <div class="row">
                    <div class="col-md-3">Активна / Деактивирована</div>
                    <div class="col-md-9">
                        <?= $form
                            ->field($formModel, 'status', ['options' => ['style' => 'display:none;']])
                            ->hiddenInput(['value' => 0])->label(false)
                        ?>
                        <?= $form
                            ->field($formModel, 'status',['template' => "{input}\n{hint}\n{error}",'horizontalCssClasses' => [
                                'wrapper' => 'top-minus','offset'=>''
                            ]])->checkbox()->label("");
                        ?>
                    </div>
                </div>

                <?= $form->field($formModel, 'category_ids',['options'=>['class'=>'form-group row']])->checkboxList(
                    \backend\modules\categories\models\Category::getList('id', 'title', 'id desc')
                )->label($formModel->getAttributeLabel('category_ids')); ?>

                <?= $form->field($formModel, 'params_ids',['options'=>['class'=>'form-group row']])->checkboxList(
                    \backend\modules\parametrs\models\Parametrs::getList('id', 'title', 'id desc')
                )->label($formModel->getAttributeLabel('params_ids')); ?>


                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Баннер</h4>
                <br />

                <?php

                    echo \wbp\imageUploader\ImageUploader::widget([
                        'style' => 'estoreMultiple',
                        'data' => [
                            'size'=>'123x123',
                        ],
                        'type' => \backend\modules\objectTypes\models\ObjectTypes::$imageTypes[0],
                        'item_id' => $formModel->id,
                        'limit' => 1
                    ]);

                ?>
                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \yii\bootstrap\ActiveForm::end(); ?>

