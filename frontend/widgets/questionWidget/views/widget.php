<?php
use backend\modules\trainings\models\Trainings;
use backend\modules\events\models\Events;
use \yii\helpers\ArrayHelper;

    $bundle = \frontend\assets\ImageAsset::register($this);
    \wbp\jqueryTools\JqueryTools::register($this);

    function stripTagsFromArray($a){
        return strip_tags($a);
    }

    $trainings_array = array_map("stripTagsFromArray", Trainings::getList('id','title', 'title'));
    $events_array = array_map("stripTagsFromArray", Events::getList('id','title', 'title', 'date > NOW()'));

?>

<div class="order-training-form">
    <div class="order-form-close">
        <img src="<?= $bundle->baseUrl ?>/images/close-order.svg" alt="Close">
    </div>
    <? $form = \yii\bootstrap\ActiveForm::begin(['action'=>['site/submit-form']]); ?>

        <?= $form->field($model, 'return')->hiddenInput()->label(false);?>

        <?= $form->field($model, 'fname')->textInput(['placeholder' => 'Имя'])->label(false)?>
        <?= $form->field($model, 'lname')->textInput(['placeholder' => 'Фамилия'])->label(false)?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false)?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
        <?=$form->field($model,'training_id', [ 'options' => ['class'=>'training']])
            ->dropDownList(ArrayHelper::merge(['Выбрать тренинг'], $trainings_array))
            ->label(false)
        ?>

        <?=$form->field($model,'event_id', [ 'options' => ['class'=>'event']])
            ->dropDownList(ArrayHelper::merge(['Выбрать событие'], $events_array))
            ->label(false)
        ?>

        <?= $form->field($model, 'message')->textarea(['placeholder' => 'Дополнительная информация'])->label(false)?>
        <?=\yii\helpers\Html::submitInput('Отправить', ['class'=>'order-submit'])?>
    <? \yii\bootstrap\ActiveForm::end(); ?>
</div>
