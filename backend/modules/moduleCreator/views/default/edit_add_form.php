<?
$DEFAULT_PATH_TO_MODULE = 'backend\\modules\\';
$form=\yii\widgets\ActiveForm::begin(); ?>

    <div class="widget">
        <div class="widget-head">
            <h4 class="heading glyphicons circle_info"><i></i>Basic info</h4>
        </div>

        <div class="widget-body">

            <div class="row">

                <!-- Column -->
                <div class="col-md-4">
                    <strong>Module <?=$formModel->getAttributeLabel('title')?></strong>
                    <p class="muted">Will be used for indentify module</p>
                </div>
                <!-- // Column END -->

                <?=$form
                    ->field($formModel,'title',[
                        'options'=>[
                            'class'=>'col-md-8'
                        ]
                    ])
                    ->textInput([
                        'placeholder'=>'Enter module title here...'
                    ])->label(false)
                ?>

                <div class="separator bottom"></div>

            </div>

            <hr class="separator bottom">

            <div class="row">

                <!-- Column -->
                <div class="col-md-4">
                    <strong>Module <?=$formModel->getAttributeLabel('name')?></strong>
<!--                    <p class="muted">Will be used for indentify module</p>-->
                </div>
                <!-- // Column END -->

                <?=$form
                    ->field($formModel,'name',[
                        'options'=>[
                            'class'=>'col-md-8'
                        ]
                    ])
                    ->textInput([
                        'placeholder'=>'Enter module title here...'
                    ])->label(false)
                ?>

                <div class="separator bottom"></div>

            </div>

            <hr class="separator bottom">

            <div class="row">

                <!-- Column -->
                <div class="col-md-4">
                    <strong>Module <?=$formModel->getAttributeLabel('status')?></strong>
                    <p class="muted">Active / Inactive category</p>
                </div>
                <!-- // Column END -->
                <?=$form
                    ->field($formModel,'status',[
                        'options'=>[
                            'style'=>'display:none;'
                        ]
                    ])
                    ->hiddenInput(['value'=>0])
                    ->label(false)
                ?>
                <?=$form
                    ->field($formModel,'status',[
                        'options'=>[
                            'class'=>'col-md-8'
                        ]
                    ])
                    ->checkbox([
                        'label'=>'',
                        'labelOptions'=>[
                            'class'=>"make-switch",
                            "data-on"=>"success",
                            "data-off"=>"danger"
                        ]
                    ])->label("");
                ?>

                <div class="separator bottom"></div>

            </div>

        </div>
        <hr class="separator bottom">
        <div class="widget-body">

            <div class="row">
                <div class="col-md-4">
                    <strong>Module <?=$formModel->getAttributeLabel('class_name')?></strong>
                    <p class="muted">Path on server <br/>(usually starts from <i><strong  style="cursor: pointer" title="Click to Insert Default Path"><?=$DEFAULT_PATH_TO_MODULE?></strong></i>)</p>
                </div>
                <?=$form
                    ->field($formModel,'class_name',[
                        'options'=>[
                            'class'=>'col-md-8'
                        ]
                    ])
                    ->textInput([
                        'placeholder'=>'Enter path here...',
                    ])->label(false)
                ?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="buttons pull-right">
        <?=\yii\helpers\Html::submitButton('Submit',['class'=>'btn btn-primary'])?>
    </div>

    <div class="clearfix"></div>
    <div class="separator bottom"></div>
<?
$DEFAULT_PATH_TO_MODULE = str_replace('\\',"\\\\",$DEFAULT_PATH_TO_MODULE);
$this->registerJs(<<<T_START_HEREDOC
     $(".muted i strong").on("click",function(e){

        var el = $("#modulesform-class_name");
        if(el.val() == ""){
            var name = $("#modulesform-name").val() || '___!!!ENTER_MODULE_NAME_HERE!!!___';
            var n_val = "$DEFAULT_PATH_TO_MODULE"+name+"\\\\Module";
            el.focus();
            el.val("").val(n_val);
        }
    }).click();
T_START_HEREDOC
    , \yii\web\View::POS_READY);
?>

<? \yii\widgets\ActiveForm::end();?>