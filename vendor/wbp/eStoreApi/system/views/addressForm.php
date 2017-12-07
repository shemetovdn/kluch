<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 10/8/2015
 * Time: 11:51
 */

use wbp\eStoreApi\system\models\Countries;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$country_name=Html::getInputName($model, 'country_id');
$state_name=Html::getInputName($model, 'state_id');
$existing_address_name=Html::getInputName($model, 'existing_address');
$formName = $model->formName();

$this->registerJs('
    $("[name=\''.$country_name.'\']").statelist({
        stateList: $("[name=\''.$state_name.'\']"),
        stateUrl: "'.Url::to(['system/get-regions']).'"
    });
',\yii\web\View::POS_END);

$this->registerJs('
    var '.$formName.'_interval;
    $("[name=\''.$existing_address_name.'\']").change(function(){
        if($(this).val()!=0){
            $.ajax({url:"'.Url::to(['system/get-address']).'?id="+$(this).val(),success:function(data){
                data=JSON.parse(data);
                jQuery.each(data,function(i, val){
                    if($("[name=\''.$formName.'["+i+"]\']").prop("tagName")=="SELECT" && !$("[name=\''.$formName.'["+i+"]\']").find("[value="+val+"]").length){
                        '.$formName.'_interval=setInterval(function(){
                            if($("[name=\''.$formName.'["+i+"]\']").find("[value="+val+"]").length){
                                $("[name=\''.$formName.'["+i+"]\']").val(val);
                                $("[name=\''.$formName.'["+i+"]\']").change();
                                $("[name=\''.$formName.'["+i+"]\']").attr("disabled","disabled");
                                clearInterval('.$formName.'_interval);
                            }
                        },100);
                    }else{
                        if($("[name=\''.$formName.'["+i+"]\']").val()!=val){
                            $("[name=\''.$formName.'["+i+"]\']").val(val);
                            $("[name=\''.$formName.'["+i+"]\']").change();
                        }
                    }
                    $("[name=\''.$formName.'["+i+"]\']").attr("disabled","disabled");

                });
            }});
        }else{

            $("[name^='.$formName.']").attr("disabled",false).removeAttr("disabled");
        }
    }).change();
',\yii\web\View::POS_END);

?>

<?
    if(!$form) {
        $formEnd=true;
        $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'offset' => '',
                    'wrapper' => 'col-md-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]);
    }
?>

    <?
        if(count(Yii::$app->user->identity->addressesList)){
            echo $form->field($model, 'existing_address')->dropDownList(ArrayHelper::merge(['New Address'],Yii::$app->user->identity->addressesList));
            echo '<div class="clear" style="height: 30px;"></div>';
        }

    ?>

    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::merge(['Select Country'],Countries::getCountriesList())) ?>
    <?
        $options=[];
        if(!$model->country_id) $options=['disabled'=>'disabled'];
        echo $form
            ->field($model, 'state_id')
            ->dropDownList(
                ArrayHelper::merge(
                    ['Select State'],
                    (array)Countries::getCountryById($model->country_id)->regionsList
                ),
                $options
            )
    ?>
    <?= $form->field($model, 'city')->textInput() ?>
    <?= $form->field($model, 'address')->textInput() ?>
    <?= $form->field($model, 'address1')->textInput() ?>
    <?= $form->field($model, 'zip')->textInput() ?>



<?
    if($formEnd){
        ActiveForm::end();
    }
?>

