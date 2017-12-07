<?

use backend\modules\pages\models\Pages;
use wbp\widgets\TitleToUrlTransformation;

TitleToUrlTransformation::widget([
    'from' => "$('#pagesform-title')",
    'to' => "$('#pagesform-href')"
]);

$urlGetContents = \yii\helpers\Url::to(['get-content']);
$this->registerJs(<<<JS

    $(".btn.btn-success.addContent").unbind("click").on("click", getContents);
    $(document).on("click",".btn.btn-warning.deleteContent",function(){
        var el = $(this);
        var p_w = el.parents(".conta");
       swal({
            title: "Вы серьезно?",
            text: "Вы действительно хотите удалить этот элемент?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Да, удалить его",
            cancelButtonText: "Отмена",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                p_w.fadeOut(function() {
                    p_w.prev(".separator.bottom").remove();
                    p_w.next(".clearfix").remove();
                    CKEDITOR.instances[p_w.find($("textarea[id^='ck_']")).attr("id")].destroy();
                    p_w.remove();
                });
                swal({
                    title: "Удален!",
                    text: "Ваш поразительный объект удален.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            } else {
                swal({
                    title: "Отмена",
                    text: "Ваш поразительный объект сохранен :)",
                    type: "error",
                    confirmButtonClass: "btn-danger"
                });
            }
        });
       return false;
    });

    function getContents(){
        $.post("$urlGetContents",{},function(data){
            $("#placeholders_for_contentEditors").append(data);
        });
    }

    $("#placeholders_for_contentEditors").sortable({
        placeholder: "ui-state-highlight",
        handle:".widget-head",
        cursor:"move",
        items:".widget",
        start: function (event, ui) {
            for(var name in CKEDITOR.instances){
                CKEDITOR.instances[name].destroy();
            }
        },
        stop: function (event, ui) {
            $("textarea[id^='ck_']").each(function(k,v){
                var el = $(v);
                CKEDITOR.replace(el.attr("id"));
            });
        }
    });
JS
    , yii\web\View::POS_END);
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
                    <h4>Информация о странице</h4>
                    <br />


                    <?= $form
                        ->field($formModel, 'title',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder' => 'Введите название...'
                        ])->label("Название страници")
                    ?>

                    <?=$form
                        ->field($formModel, 'href',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder' => 'Введите url ...',
                            'readonly' => $readonly,
                            'disabled' => $disabled
                        ])->label("URL страници");
                    ?>

                    <?= $form
                        ->field($formModel, 'parent_page',['options'=>['class'=>'form-group row']])
                        ->dropDownList(\yii\helpers\ArrayHelper::merge(['0' => 'Это главная страница'], Pages::getHierarchy()))
                        ->label("Родительская страница");
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


                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-3">
                                <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                                <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                            </div>
                        </div>
                    </div>

                    <h4><?= Yii::t('admin', 'Banner') ?></h4>
                    <br />

                    <?=$form
                        ->field($formModel, 'banner_title',['options'=>['class'=>'form-group row']])
                        ->textInput([
                            'placeholder' => 'Введите текст банера...',
                            'readonly' => $readonly,
                            'disabled' => $disabled
                        ])->label("Текст баннера");
                    ?>

                    <?=$form
                        ->field($formModel,'short_description',['options'=>['class'=>'form-group row']])
                        ->widget(\wbp\widgets\LimitedTextArea::classname(), [
                            'options'=>[
                                'class'=>'form-control',
                                'placeholder'=>Yii::t('admin','Enter description here...')
                            ]
                        ])->label(Yii::t('admin',Yii::t('admin','Short description')))
                    ?>

                    <h4>Изображение</h4>
                    <br />
                    <?php

                    echo \wbp\imageUploader\ImageUploader::widget([
                        'style' => 'estoreMultiple',
                        'data' => [
                            'size' => '123x123',
                        ],
                        'type' => Pages::$imageTypes[0],
                        'item_id' => $formModel->id
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

</section>

<section class="panel">

    <div id="placeholders_for_contentEditors">
        <?
        echo \yii\helpers\Html::hiddenInput($formModel->formName() . '[content]', '');
        if (is_array($formModel->content))
            echo \yii\widgets\ListView::widget([
                'layout' => '{items}',
                'itemOptions' => ['tag' => false],
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $formModel->content]),
                'emptyText' => '',
                'itemView' => function ($model) {
                    $formModel = new \backend\modules\pages\models\PagesForm();
                    return $this->render('contentEditor', ['formModel' => $formModel, 'value' => $model]);
                }
            ]) ?>

    </div>

    <div style="padding: 15px 15px 0">
        <input type="button" class="btn btn-success addContent" value="<?= Yii::t('admin', 'Add More Content') ?> ">

        <div class="form-actions">
            <div class="form-group row">
                <div class="col-md-9 col-md-offset-3">
                    <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                    <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                </div>
            </div>
        </div>
    </div>



</section>
<? \yii\bootstrap\ActiveForm::end(); ?>

