<?
use backend\modules\stores\models\Stores;
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
                <h4>Информация</h4>
                <br />

                <?= $form->field($formModel, 'id')->hiddenInput()->label(false) ?>


                <?= $form
                    ->field($formModel, 'title',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите заголовок...'])->label("Заголовок страници")
                ?>
                <div class="row">
                    <div class="col-md-3">Активна / Деактивирована</div>
                    <div class="col-md-9">
                        <?= $form
                            ->field($formModel, 'status', ['options' => ['style' => 'display:none;']])
                            ->hiddenInput(['value' => 0])->label(false)
                        ?>
                        <?= $form
                            ->field($formModel, 'status',['template' => "{input}\n{hint}\n{error}",'horizontalCssClasses' => [
                                'wrapper' => 'top-minus','offset'=>''
                            ]])->checkbox()->label("");
                        ?>
                    </div>
                </div>

                <?= $form
                    ->field($formModel, 'description',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите описание...'])->label("Описание страници")
                ?>

                <?= $form
                    ->field($formModel, 'keywords',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите ключевые слова...'])->label("Ключевые слова")
                ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>OG теги</h4>
                <br />

            <?= $form
                ->field($formModel, 'og_title',['options'=>['class'=>'form-group row']])
                ->textInput(['placeholder'=>'Введите заголовок...'])->label("Заголовок страници (og:title)")
            ?>

            <?= $form
                ->field($formModel, 'og_description',['options'=>['class'=>'form-group row']])
                ->textInput(['placeholder'=>'Введите описание...'])->label("Описание страници (og:description)")
            ?>
            <?= $form
                ->field($formModel, 'og_type',['options'=>['class'=>'form-group row']])
                ->textInput(['placeholder'=>'Введите тип...'])->label("Тип страници (og:type)")
            ?>

            <?= $form
                ->field($formModel, 'og_url',['options'=>['class'=>'form-group row']])
                ->textInput(['placeholder'=>'Введите url...'])->label("Url страници (og:url)")
            ?>
                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>og:image</h4>
                <br />

                <?php

                echo \wbp\imageUploader\ImageUploader::widget([
                    'style' => 'estoreMultiple',
                    'data' => [
                        'size'=>'123x123',
                    ],
                    'type' => \backend\modules\seo\models\SEO::$imageTypes[0],
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



<? \yii\bootstrap\ActiveForm::end(); ?>
