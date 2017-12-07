<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form =ActiveForm::begin(
    [
        'action'=>['auth/login'],
        'id'=>'main_login_form',
        'enableAjaxValidation' => true
    ]
);?>
<div class="login_mask"></div>
<?= $form->field($loginFormModel, 'return',['options'=>['style'=>'display:none']])->hiddenInput()->label(false) ?>
    <div style="clear:both; height: 1px"></div>
<?= $form->field($loginFormModel, 'username')->textInput()->label(null,['class'=>"name"])?>
    <div  class="clearfix" style="height: 24px;"></div>
<?= $form->field($loginFormModel, 'password')->passwordInput()->label(null,['class'=>"name"]);?>
    <div  class="clearfix" style="height: 5px;"></div>
    <a
        <?=\wbp\uniqueOverlay\UniqueOverlay::widget(['url'=>['auth/forgot'],'htmlClass'=>'forgot'])?>
        style="cursor: pointer"
    >Forgot Password?</a>
    <div style="clear:both; height: 40px"></div>
<?=Html::submitButton('LOGIN', ['name' => 'login-button']) ?>
<?php ActiveForm::end(); ?>
    <div style="clear:both; height: 30px"></div>
    <div class="line">
        <div class="or">OR</div>
    </div>
    <div style="clear:both; height: 30px"></div>
<?=Html::a("Login Using Facebook",['auth/login','service'=>'facebook'],['class'=>'logface'])?>
    <div style="clear:both; height: 13px"></div>
<?=Html::a("Login Using Twitter",['auth/login','service'=>'twitter'],['class'=>'logtwi'])?>
    <div style="clear:both;"></div>
<?
$this->registerJs('
        $("#main_login_form").on("beforeSubmit",function(){
           $(".login_mask").stop(true,true).show().animate({opacity:0.8},300);
        });

    ',\yii\web\View::POS_END);
?>