<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 10/7/2015
 * Time: 10:51
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
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
]); ?>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'password_confirmation')->passwordInput() ?>

<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'first_name') ?>
<?= $form->field($model, 'last_name') ?>
<?= $form->field($model, 'phone') ?>

<div class="form-group">
    <div class="col-md-12">
        <?= Html::submitButton('Register', ['class' => 'btn btn-primary pull-right', 'name' => 'register-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
