<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 10/8/2015
 * Time: 11:30
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'step-2-form',
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

$this->registerJs('
    $("#step-2-form").submit(function(){
        $(this).find("input, select, textarea").attr("disabled","disabled").removeAttr("disabled");
    })
',\yii\web\View::POS_END);

?>


<div class="clear" style="height: 50px;"></div>

<div class="row">

    <div class="col-md-6">

        <div class="row">
            <div class="col-md-12">
                <h3>Shipping Address</h3>
            </div>
        </div>

        <div class="clear" style="height: 50px;"></div>

        <?=Yii::$app->controller->renderPartial(Yii::$app->controller->viewsSystemPath . 'addressForm', ['form' => $form, 'model'=>$shippingAddressForm]);?>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h3>Billing Address</h3>
            </div>
        </div>

        <div class="clear" style="height: 50px;"></div>

        <?=Yii::$app->controller->renderPartial(Yii::$app->controller->viewsSystemPath . 'addressForm', ['form' => $form, 'model'=>$billingAddressForm])?>

        <div class="form-group">
            <div class="col-md-12">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>
</div>



<?
    ActiveForm::end();
?>