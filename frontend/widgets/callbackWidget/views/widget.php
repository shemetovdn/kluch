<!-- Modal -->
<div class="modal fade agents-call-back-modal-block-out" id="сallBackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="agents-call-back-modal-block">

            <button data-dismiss="modal" class="close-button"></button>

            <div class="title">
                Обратный звонок
            </div>

            <? $form = \yii\bootstrap\ActiveForm::begin(['action'=>'/site/submit-form']); ?>

                <?= $form->field($model, 'fname')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>
                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
                <?= $form->field($model, 'message')->textarea(['placeholder' => 'Ваш вопрос'])->label(false)?>
                <?=\yii\helpers\Html::button('Перезвонить', ['type'=>'submit', 'class'=>'button--isi button btn-radius'])?>

            <? \yii\bootstrap\ActiveForm::end(); ?>

        </div>
    </div>
</div>
