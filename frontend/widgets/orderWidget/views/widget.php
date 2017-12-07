<?php
    use yii\bootstrap\ActiveForm;
?>

<div class="order-form white-text">

    <div class="title">
        Заказать услуги
    </div>

    <div class="description">
        Заполните заявку и мы свяжемся с вами для обсуждения задач.<br />
        Или просто позвоните нам: <span><?=\common\models\Config::getParameter('phone')?></span>
    </div>

    <?
        if (isset($_SERVER['REQUEST_URI'])) {
            $return = $_SERVER['REQUEST_URI'];
        } else $return = '/';
    ?>

    <? $form = ActiveForm::begin(['action'=>['site/order-property-managment']]); ?>
        <?= $form->field($model, 'return')->hiddenInput(['value'=>$return])->label(false);?>
        <?= $form->field($model, 'type')->hiddenInput(['value'=>'1'])->label(false)?>
        <?= $form->field($model, 'fname')->textInput(['placeholder' => 'Имя'])->label(false)?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false)?>
        <?= $form->field($model, 'message')->textarea(['placeholder' => 'Дополнительная информация'])->label(false)?>
        <?=\yii\helpers\Html::button('Отправить', ['class'=>'button--isi button btn-radius', 'type'=>'submit'])?>
    <? ActiveForm::end(); ?>

</div>
