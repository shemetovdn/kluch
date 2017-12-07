<?
    use common\models\Promo;
    use backend\modules\agents\models\Agents;


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
                <h4>Информация об аутентификации</h4>
                <br />

            <?=$form
                ->field($formModel,'username',['options'=>['class'=>'form-group row']])
                ->textInput([
                    'placeholder'=>'Enter user name here...'
                ])
            ?>

            <?=$form
                ->field($formModel,'email',['options'=>['class'=>'form-group row']])
                ->textInput([
                    'placeholder'=>'Enter email here...'
                ])
            ?>

            <?=$form
                ->field($formModel,'password',['options'=>['class'=>'form-group row']])
                ->passwordInput([
                    'placeholder'=>'введите пароль...'
                ])->label("Пароль");
            ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Общая информация</h4>
                <br />

                <?php
                    if($formModel->userData){
                        $formModel = $formModel->userData;
                    }
                ?>
                <?=$form
                    ->field($formModel,'first_name',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder'=>'ведите имя...',
                    ])->label("Имя");
                ?>
                <?=$form
                    ->field($formModel,'last_name',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder'=>'ведите фамилию...',
                    ])->label("Фамилия");
                ?>
                <?=$form
                    ->field($formModel,'phone',['options'=>['class'=>'form-group row']])
                    ->textInput([
                        'placeholder'=>'ведите телефон...',
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

                <h4><?=Yii::t('admin','Информация')?></h4>
                <br />

                <div class="row">
                    <?=$form
                        ->field($formModel,'information',['horizontalCssClasses' => [
                            'wrapper' => 'col-xs-12','offset'=>''
                        ]])
                        ->widget(\mihaildev\ckeditor\CKEditor::className(), [
                            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder',\yii\helpers\ArrayHelper::merge(Yii::$app->params['ckeditor'],['height'=>'200'])),
                        ])->label(false);
                    ?>
                </div>
                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Фото</h4>
                <br />

                <?php

                    echo \wbp\imageUploader\ImageUploader::widget([
                        'style' => 'estoreMultiple',
                        'data' => [
                            'size' => '123x123',
                        ],
                        'type' => Agents::$imageTypes[0],
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

<? \yii\bootstrap\ActiveForm::end(); ?>

