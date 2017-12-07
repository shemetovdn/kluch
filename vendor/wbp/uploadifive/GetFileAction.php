<?php

namespace wbp\uploadifive;

use wbp\helpers\FileSizeHumanize;
use wbp\file\File;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class GetFileAction extends \yii\base\Action
{

    public function run()
    {
        $tmp = Yii::$app->getRequest()->post('tmp');
        $type = Yii::$app->getRequest()->post('type');
        $itemId = (int)Yii::$app->getRequest()->post('item_id');
        $limit = (int)Yii::$app->getRequest()->post('limit');
        $unique_id = Yii::$app->getRequest()->post('uniqueId');
        $data = json_decode(Yii::$app->getRequest()->post('data'), true);

        if (!$data['size']) $data['size'] = '123x123';


        if (!$limit) $limit = 1000;

        $options = [];
        $tmp_options = [];

        $tmp_options['item_id'] = null;
        $tmp_options['type'] = $type;
        $tmp_options['unique_id'] = $unique_id;

        if (!$tmp) {
            $options['status'] = File::STATUS_ACTIVE;
        }

        $options['item_id'] = $itemId;
        $options['type'] = $type;
        $options['deleted'] = File::NON_DELETED;


        if ($tmp && (int)$itemId) $Files = File::find()->where($options)->orWhere($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($tmp && !(int)$itemId) $Files = File::find()->where($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($itemId) $Files = File::find()->where($options)->orderBy('sort, id desc')->limit($limit);

        if ($Files)
            foreach ($Files->each() as $File) {

                $filePlaced = Yii::getAlias(Yii::$app->getModule('file')->fileStorePath.DIRECTORY_SEPARATOR.$File->id.".".$File->ext);
                $filesize = '<span style="color:red">Can\'t get file!!!</span>';
                if(is_file($filePlaced)) {
                    $filesize = FileSizeHumanize::calc_size($filePlaced);
                }
                $removeButtonId = uniqid("FileRemoveButton_");
                $content = '<div style="position: relative;width: 123px;height: 123px"><File controls style="display:flex;position:absolute;width:100%;height:100%;align-items:center;;overflow: hidden">';
                $content .= '<span style="text-align: center;width: 100%;line-height: normal;box-sizing: border-box;padding: 10px;word-wrap: break-word;color:#000000;text-shadow: 1px 1px 1px rgba(255,255,255, 1);">
                        <b style="text-decoration: underline">File: </b><br/><i>'.$File->name.'</i><br/>
                        <b style="text-decoration: underline">Size: </b><br/><i>'.$filesize.'</i>
                    </span><br/>
                </File></div>';
//                $content = Html::img($image->getUrl($data['size'], $method));
                $content .= "<a href='' class='removeImage' id='" . $removeButtonId . "'></a>";

                echo Html::tag('div', $content, ['class' => 'image']);
//            echo $unique_id;
            echo '
                <script>
                    $("#' . $removeButtonId . '").click(function(){
                        $.post("' . Url::to(['deleteFile']) . '",{id:"' . $File->id . '"},function(){
                            reload_' . $unique_id . '();
                        });
                        $(this).parent().remove();
                        return false;
                    });
                </script>
            ';


                //echo $image->getUrl('123x89');
            }

    }


}
