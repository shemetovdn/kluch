<?

$this->title='Ваш профиль';

?>
<section class="panel">
    <div class="panel-heading">
        <h3><?=$this->title?></h3>
    </div>

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
                    <h4>Информация для аунтентификации</h4>
                    <br />

                    <?=$form
                        ->field($formModel,'username',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder'=>'введите имя пользователя...'
                        ])->label('Ваше имя пользователя')
                    ?>

                    <?=$form
                        ->field($formModel,'email',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder'=>'введите email...'
                        ])->label('Ваш email')
                    ?>

                    <?=$form
                        ->field($formModel,'password',['options'=>['class'=>'form-group row']])
                        ->passwordInput([
                            'placeholder'=>'введите пароль...'
                        ])->label('Ваш пароль')
                    ?>

                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-3">
                                <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                                <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                            </div>
                        </div>
                    </div>

                    <h4>Информация о вас</h4>
                    <br />

                    <?=$form
                        ->field($formModel,'first_name',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder'=>'Введите ваше имя...',
                        ])->label('Ваше имя')
                    ?>

                    <?=$form
                        ->field($formModel,'last_name',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder'=>'Введите вашу фамилию...',
                        ])->label('Ваша фамилия')
                    ?>

                    <?=$form
                        ->field($formModel,'phone',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder'=>'Введите ваш телефон...',
                        ])->label('Ваш телефон')
                    ?>

                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-3">
                                <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                                <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                            </div>
                        </div>
                    </div>

                    <h4>Ваш аватар</h4>
                    <br />
                    <?php

                        echo \wbp\imageUploader\ImageUploader::widget([
                            'style' => 'estoreMultiple',
                            'data' => [
                                'size'=>'123x123',
                            ],
                            'type' => \common\models\User::$imageTypes[0],
                            'item_id' => $formModel->id,
                            'limit' => 1
                        ]);

                    ?>
                    <div class="clearfix"></div>
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
    <? \yii\bootstrap\ActiveForm::end();?>
</section>

