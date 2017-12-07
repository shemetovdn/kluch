<?
    use common\models\Promo;
    use backend\modules\agents\models\Agents;
$bundle = backend\modules\parametrs\paramAsset::register($this);


?>

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

<div class="panel-body"  ng-app="Admin">
    <div class="row"   ng-controller="ParametrsController as parametrs"   ng-init="parametrs.init(<?php echo $formModel->id;?>)">
        <div class="col-lg-12">
            <div class="margin-bottom-50">
                <h4>Параметр</h4>
                <br />


                <?=$form
                    ->field($formModel,'title',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите заголовок...'])->label('Название')
                ?>

                <div class="row">
                    <div class="col-md-3">Активн / Деактивирован</div>
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

                <?= $form
                    ->field($formModel, 'field_type_id',['options'=>['class'=>'form-group row']])
                    ->dropDownList(
                        \backend\modules\parametrs\models\FieldType::getList('id', 'value', 'id desc')
                    )
                    ->label($formModel->getAttributeLabel('field_type_id'));
                ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

<div id="values">

    <h4 class="pull-left">Значения параметра</h4>
    <p class="btn btn-success pull-right" style="margin-bottom: 0;"  ng-click="parametrs.addValue()"  data-count="{{parametrs.count}}">Добавить Значение</p>

    <div class="clearfix"></div>
    <br />
    <div class="row" id="field_value">
        <div   ng-repeat="item in parametrs_list track by $index"  class="col-md-4" style="margin-bottom: 15px;">
            <span class="close"   ng-click="parametrs.deleteValue(item.id, parametrs.count = $index)">x</span>
            <input type="text"  class="form-control" name="ParametrsValue[field_value][{{parametrs.count = $index}}][value]" value="{{item.value}}">
            <input type="hidden"  class="form-control" name="ParametrsValue[field_value][{{parametrs.count = $index}}][id]" value="{{item.id}}">

            <div class="help-block"></div>
        </div>
    </div>
    <div class="form-actions">
        <div class="form-group row">
            <div class="col-md-9 col-md-offset-3">
                <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
            </div>
        </div>
    </div>
</div>

                <?php
                    $this->registerJs('
 
                        
                        $("#parametrs-field_type_id").change(function(){
                        if($(this).val() != 3){
                            $("#values").css("display","block")
                        }else{$("#values").css("display","none")}
                        });
                    ',yii\web\View::POS_READY);
                ?>


            </div>
        </div>
    </div>
</div>

<? \yii\bootstrap\ActiveForm::end(); ?>

