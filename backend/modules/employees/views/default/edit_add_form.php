<?
use common\models\Promo;

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

<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-bottom-50">
                <h4><?= Yii::t('admin', 'Auth information')?></h4>
                <br />

                <?= $form
                    ->field($formModel, 'username',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder' => 'Введите Логин...'
                    ])->label("Логин пользователя");
                ?>

                <?= $form
                    ->field($formModel, 'email',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder' => Yii::t('admin', 'Введите email...')
                    ])->label("Email пользователя")
                ?>


                <?= $form
                    ->field($formModel, 'password',['options'=>['class'=>'form-group row']])
                    ->passwordInput([
                        'placeholder' => 'Пароль...'
                    ])->label("Пароль пользователя");
                ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4><?= Yii::t('admin', 'General information')?></h4>
                <br />


                <?= $form
                    ->field($formModel, 'first_name',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder' => Yii::t('admin', 'Введите Имя...'),
                    ])->label("Имя");
                ?>
                <?= $form
                    ->field($formModel, 'last_name',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder' => 'Введите Фамилию...',
                    ])->label("Фамилия");
                ?>
                <?= $form
                    ->field($formModel, 'phone',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder' => 'Введите телефон...',
                    ])->label("Телефон");
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

</section>

<section>


            <?= \wbp\widgets\Permissions::widget(['formModel' => $formModel]); ?>

<? \yii\bootstrap\ActiveForm::end(); ?>

