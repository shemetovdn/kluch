<?php

namespace wbp\uploadifive;

use wbp\images\models\Image;
use wbp\video\Video;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class DeleteVideoAction extends \yii\base\Action {

    public function run() {

        $id=(int)Yii::$app->getRequest()->post('id');

        $video=Video::findOne($id);
        if($video->id){
            $video->delete();
        }

    }


}
