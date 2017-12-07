<?
use backend\modules\adverts\models\Adverts;
use common\models\User;

$this->registerJs('
$("#router-category_id").change(function(){
var id = $(this).val();
$.ajax({
    url:"default/get-object-types",
    type:"POST",
    data: "id="+id,
    success: function(data){
    data = JSON.parse(data);
    var html = "<option value=\"\">Выберите тип объекта</option>";
    $.each( data, function( key, value ) {
      html += "<option value=\" "+value.id+"\">"+value.title+"</option>";
});
$("#router-object_type_id").html(html);
    }
})
})  
        
'
    , yii\web\View::POS_END);
?>

<? $form=\yii\bootstrap\ActiveForm::begin([
    'action'=>'route-by-type',
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


<section class="panel">
    <div class="panel-heading">
        <h3>Тип объявления</h3>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">

                    <?= $form
                        ->field($formModel, 'category_id',['options'=>['class'=>'form-group row']])
                        ->dropDownList(
                            \yii\helpers\ArrayHelper::merge(
                                ['' => 'Выберите тип объвления'],
                                \backend\modules\categories\models\Category::getList('id', 'title', 'id desc'))
                        )
                        ->label(\Yii::t('admin', 'Category'));
                    ?>

                    <?= $form
                        ->field($formModel, 'object_type_id',['options'=>['class'=>'form-group row']])
                        ->dropDownList(
                            \yii\helpers\ArrayHelper::merge(
                                ['' => 'Выберите тип объекта'],
                                \backend\modules\adverts\models\ObjectTypes::getList('id', 'title', 'id desc'))
                        )
                        ->label($formModel->getAttributeLabel('object_type_id'));
                    ?>


                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-3">
                                <?=\yii\helpers\Html::submitButton('Далее',['class'=>'btn width-150 btn-primary'])?>
                                <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<? \yii\bootstrap\ActiveForm::end(); ?>