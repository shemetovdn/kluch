<?php

namespace wbp\uploadifive;

use wbp\images\models\Image;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Sortable;

class GetAction extends \yii\base\Action
{

    public function run()
    {
        $tmp = Yii::$app->getRequest()->post('tmp');
        $type = Yii::$app->getRequest()->post('type');
        $itemId = (int)Yii::$app->getRequest()->post('item_id');
        $limit = (int)Yii::$app->getRequest()->post('limit');
        $unique_id = Yii::$app->getRequest()->post('uniqueId');
        $data = json_decode(Yii::$app->getRequest()->post('data'), true);
        $showUrlOptions = Yii::$app->getRequest()->post('showUrl');

        if (!$data['size']) $data['size'] = '123x123';

        list($width,$height) = explode("x",$data['size']);

        if (!$limit) $limit = 1000;

        $options = [];
        $tmp_options = [];

        $tmp_options['item_id'] = 0;
        $tmp_options['type'] = $type;
        $tmp_options['unique_id'] = $unique_id;

        if (!$tmp) {
            $options['status'] = Image::STATUS_ACTIVE;
        }

        $options['item_id'] = $itemId;
        $options['type'] = $type;
        //$options['parent'] = NULL;
        $options['deleted'] = Image::NON_DELETED;


        if ($tmp && (int)$itemId) $images = Image::find()->where($options)->orWhere($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($tmp && !(int)$itemId) $images = Image::find()->where($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($itemId) $images = Image::find()->where($options)->orderBy('sort, id desc')->limit($limit);

        if ($images) {
            foreach ($images->each() as $image) {
                $sizes = $image->getSizes();

                $method = Image::RESIZE_METHOD_CROP;
                if (($sizes['width'] / 3) > $sizes['height'] || ($sizes['height'] / 3) > $sizes['width']) $method = Image::RESIZE_METHOD_CROP;

                $removeButtonId = uniqid("ImageRemoveButton_");
                $editButtonId = uniqid("ImageEditButton_");
                $content = Html::img($image->getUrl($data['size'], $method));
                $content .= '<div class="info">' . $image->name . '<br/>Size: ' . $image->width . 'x' . $image->height . '</div>';
                $content .= "<a href='' class='removeImage' id='" . $removeButtonId . "'></a>";
                $content .= "<a ".\wbp\uniqueOverlay\UniqueOverlay::widget(['url'=>['crop'],'htmlClass'=>'editImage'])." data-imageId='".$image->id."' data-type='".$image->type."'  data-itemId='".$image->item_id."'  ></a>";

                echo Html::tag('div', $content, ['class' => 'image', 'style' => 'width:123px;height:123px','data-key'=>$image->id]);
                if(isset($showUrlOptions)){
                    if(isset($showUrlOptions['showUrlEnable'])){
                        if($showUrlOptions['showUrlEnable']){
                            echo Html::tag('div',$image->getAbsoluteUrl($showUrlOptions['size']),['class' => 'imageUrlShower']);
                            echo '<script>
                                $(".imageUrlShower").click(function() {
                                    SelectTexMy(".imageUrlShower");
                                });
                                if(typeof  SelectTexMy != "function"){
                                    function SelectTexMy(element) {
                                        var doc = document
                                        , text = $(element)[0]
                                        , range, selection
                                    ;    
                                    if (doc.body.createTextRange) {
                                        range = document.body.createTextRange();
                                        range.moveToElementText(text);
                                        range.select();
                                    } else if (window.getSelection) {
                                        selection = window.getSelection();        
                                        range = document.createRange();
                                        range.selectNodeContents(text);
                                        selection.removeAllRanges();
                                        selection.addRange(range);
                                    }
                                    }
    
                                }
                            </script>';
                        }
                    }
                }
                echo '
                <script>
                    $("#' . $removeButtonId . '").click(function(){
                        $.post("' . Url::to(['deleteImage']) . '",{id:"' . $image->id . '"},function(){
                            reload_' . $unique_id . '();
                        });
                        $(this).remove();
                        return false;
                    });
                </script>
            ';

            }
        }

    }


}
