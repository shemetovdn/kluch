<?php

namespace wbp\uploadifive;

use wbp\images\models\Image;
use wbp\video\Video;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class GetVideoAction extends \yii\base\Action
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
            $options['status'] = Video::STATUS_ACTIVE;
        }

        $options['item_id'] = $itemId;
        $options['type'] = $type;
        $options['deleted'] = Video::NON_DELETED;


        if ($tmp && (int)$itemId) $videos = Video::find()->where($options)->orWhere($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($tmp && !(int)$itemId) $videos = Video::find()->where($tmp_options)->orderBy('sort, id desc')->limit($limit);
        elseif ($itemId) $videos = Video::find()->where($options)->orderBy('sort, id desc')->limit($limit);

        if ($videos)
            foreach ($videos->each() as $video) {

                $removeButtonId = uniqid("ImageRemoveButton_");
                $content = '<video width="200" height="123" controls style="display:block;">';
                if($video->getUrl('mp4')) $content .= '<source src="'.$video->getUrl('mp4').'" type="video/mp4">';
                if($video->getUrl('ogg')) $content .= '<source src="'.$video->getUrl('ogg').'" type="video/ogg">';
                $content .= 'Your browser does not support the video tag.</video>';
//                $content = Html::img($image->getUrl($data['size'], $method));
                $content .= "<a href='' class='removeImage' id='" . $removeButtonId . "'></a>";

                echo Html::tag('div', $content, ['class' => 'image']);
//            echo $unique_id;
            echo '
                <script>
                    $("#' . $removeButtonId . '").click(function(){
                        $.post("' . Url::to(['deleteVideo']) . '",{id:"' . $video->id . '"},function(){
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
