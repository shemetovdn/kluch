<section class="panel">
    <div class="panel-heading">
        <h3>Социальные сети</h3>
    </div>


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
                    <?
                        foreach($model['links'] as $item) {
                    ?>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label"><?=$item->label?></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="<?=$item->name?>" value="<?=$item->value?>" class="form-control">
                                </div>
                            </div>
                    <?php
                        }
                    ?>

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
    <? \yii\bootstrap\ActiveForm::end();?>
</section>

