<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 26.10.2015
 * Time: 13:41
 */
//var_dump($formModel);exit();
use mihaildev\ckeditor\CKEditor;

$uCKid=uniqid('ck_');
?>

    <div class="conta" style="padding: 15px;">

    <div class="widget-header">
        <h3>Контент</h3>
    </div>


        <div class="row">
            <div class="col-md-12 field-categoriesform-description">
                <?
//                $bundle = \frontend\assets\AppAsset::register($this);
                $pathToCss = $bundle->baseUrl.'/SiteCss/';
                echo \yii\helpers\Html::textarea($formModel->formName().'[content][]',$value,['id'=>$uCKid]);
                CKEditor::widget([
                    'model'=>$formModel,
                    'attribute'=>'content[]',
                    'options'=>[
                        'id'=>$uCKid
                    ],
                    'editorOptions' =>
                        \mihaildev\elfinder\ElFinder::ckeditorOptions(
                                'elfinder',
                                \yii\helpers\ArrayHelper::merge(
                                        Yii::$app->params['ckeditor'],
                                        [
                                            'height'=>'200',
                                            'allowedContent'=>true,
                                            'autoParagraph'=>false,
                                            'filebrowserBrowseUrl' => '/admin/elfinder/manager',
                                            'filebrowserImageBrowseUrl' => '/admin/elfinder/manager?filter=image',
                                            'filebrowserFlashBrowseUrl' => '/admin/elfinder/manager?filter=flash',
                                            'extraAllowedContent' => true,//'*(*);*{*}',
                                            'contentsCss'=>[
//                                                $pathToCss."marina-style.css",
//                                                $pathToCss."style_custom.css"
                                            ]
                                        ]
                            ))

                ]);
                ?>

                <div class="separator bottom"></div>
                <div style="padding: 15px 0;">
                    <input type="button"  class="btn btn-warning deleteContent pull-right" value="Удалить контент">
                </div>
            </div>

        </div>

    </div>

