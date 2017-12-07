<?
use backend\modules\stores\models\Stores;

?>

<? $form=\yii\widgets\ActiveForm::begin(); ?>

<?=$form->field($formModel,'id')->hiddenInput()->label(false)?>

<div class="widget">
    <div class="widget-head">
        <h4 class="heading glyphicons circle_info"><i></i>Basic info</h4>
    </div>

    <div class="widget-body">

        <div class="row">

            <div class="col-md-4">
                <strong>Mail template of <?=$formModel->getAttributeLabel('title')?></strong>
            </div>
            <!-- // Column END -->

            <?=$form
                ->field($formModel,'title',[
                    'options'=>[
                        'class'=>'col-md-8'
                    ]
                ])->textInput();
            ?>


            <!-- Column -->
            <div class="col-md-4">
                <strong>Mail template of <?=$formModel->getAttributeLabel('store_id')?></strong>
                <p class="muted">This mail template will be available for that store </p>
            </div>
            <!-- // Column END -->

            <?
            $storesList = \yii\helpers\ArrayHelper::merge(Yii::$app->controller->defaultStoreList,Stores::getList('id','title','title'));
            echo $form
                ->field($formModel,'store_id',[
                    'options'=>[
                        'class'=>'col-md-8'
                    ]
                ])
                ->dropDownList($storesList)
            ?>

            <!-- Column -->
            <div class="col-md-4">
                <strong>Mail template  <?=$formModel->getAttributeLabel('type_id')?></strong>
                <p class="muted">This mail template will be available for that store </p>
            </div>
            <!-- // Column END -->

            <?=$form
                ->field($formModel,'type_id',[
                    'options'=>[
                        'class'=>'col-md-8'
                    ]
                ])
                ->dropDownList(\backend\modules\mailTemplates\models\MailTemplateTypes::getList('id','title','title'))
            ?>

            <div class="separator bottom"></div>
            <!-- Column -->
            <div class="col-md-4">
                <strong>Mail template <?=$formModel->getAttributeLabel('status')?></strong>
                <p class="muted">Active / Inactive </p>
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
        </div>



    </div>
</div>
<div class="widget" id="availiable_placeholders_ajax_returner"></div>



<div class="widget">
    <div class="widget-head">
        <h4 class="heading glyphicons edit"><i></i>Mail Subject and Text</h4>
    </div>

    <div class="widget-body">
        <div class="row">
            <?=$form
                ->field($formModel,'subject',[
                    'options'=>[
                        'class'=>'col-md-8'
                    ]
                ])->textInput();
            ?>
        </div>


        <div class="row">

            <?=$form
                ->field($formModel,'text',[
                    'options'=>[
                        'class'=>'col-md-12'
                    ]
                ])
                ->widget(\mihaildev\ckeditor\CKEditor::className(), [
                    'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder',\yii\helpers\ArrayHelper::merge(Yii::$app->params['ckeditor'],['height'=>'200'])),
                ])->label(false);
            ?>

            <div class="separator bottom"></div>

        </div>


    </div>
</div>


<div class="clearfix"></div>

<div class="buttons pull-right">
    <?=\yii\helpers\Html::submitButton('Submit',['class'=>'btn btn-primary'])?>
</div>

<div class="clearfix" id="ajax_returner"></div>

<? \yii\widgets\ActiveForm::end();?>

<?
$this->registerCss('
        .adminAddedPlaceholderBlock{
            position: absolute;
            right: 2%;
            top: 20%;
        }

        .adminAddedPlaceholderBlock .backer{
            font-weight: bold;
            cursor: pointer;
            margin-left: 3px;
            color: blue;
        }
        .adminAddedPlaceholderBlock .btn.btn-primary.addPlaceholder{
            padding: 1px 11px;
            margin-top: -3px;
        }
        .adminAddedPlaceholderBlock .btn.btn-primary.addPlaceholder:after{
            content: "Attach to this template"
        }
        .btn.btn-primary.addPlaceholder.newOne:after{
            content: "Add new placeholder"
        }
        [name=\'placeholdersNewAdd\']{
            padding: 0 10px;
        }

        .form-control[name=\'placeholdersAdd\']{
            float: left;
            width: auto;
            margin-top: -7px;
            margin-right: 5px;
        }
        .delete_placeholder{
            vertical-align: super;
            font-weight: bold;
            color: #aa0000;
            padding: 3px;
            cursor:pointer;
        }

    ');

$this->registerJs('
        placeholdersAction("show");
        function placeholdersAction(action,params){
            var url = "'.\yii\helpers\Url::to(['show-placeholders']).'";
            if(action == "addNew") url =  "'.\yii\helpers\Url::to(['add-placeholders']).'";
            else if(action == "add") url =  "'.\yii\helpers\Url::to(['attach-placeholders']).'";
            else if(action == "delete") url =  "'.\yii\helpers\Url::to(['deattach-placeholders']).'";
            $.post(url,{action:action,params:params,id:"'.$formModel->id.'"},function(data){
                if(action == "show")$("#availiable_placeholders_ajax_returner").html(data);
                else{
                    $("#ajax_returner").html(data);
                }
            });
        }

        $(document).on("click",".adminAddedPlaceholderBlock .backer",function(){
            placeholdersAction("show");
        });

        $(document).on("click",".btn.btn-primary.addPlaceholder",function(){
            var el = $(this);
            if(el.hasClass("newOne")) return;
            var pl = $("[name=\'placeholdersAdd\']").val();
            placeholdersAction("add",pl);
        });


        $(document).on("click",".btn.btn-primary.addPlaceholder.newOne",function(){
            var el = $(this);
            var pl = $("[name=\'placeholdersNewAdd\']").val();
            var plD = $("[name=\'placeholdersNewAddD\']").val();
            if(pl != ""){
                bootbox.confirm("Are you sure want to add this placeholder",function(agree){
                    if(agree){
                        placeholdersAction("addNew",[pl,plD]);
                    }
                });
            }else{
                bootbox.alert("Placeholder cann\'t be empty");
            }
        });

         $(document).on("change","select[name=\'placeholdersAdd\']",function(){
            var el = $(this);
            if(el.val() == -1){
                $(".btn.btn-primary.addPlaceholder").addClass("newOne");
                el.replaceWith(\'<span class="prePlace">%</span><input name="placeholdersNewAdd" placeholder="Name"/><span class="prePlace">%</span>&nbsp;<input name="placeholdersNewAddD" placeholder="description"/><span class="backer">&#10229;</span>\');
            }
        });

        $(document).on("click",".delete_placeholder[data-id]",function(){
              var el = $(this);
              bootbox.confirm("Are you sure want to delete this placeholder",function(agree){
                    if(agree){
                        placeholdersAction("delete",el.data("id"));
                    }
                });
        });

    ',\yii\web\View::POS_END);
?>
