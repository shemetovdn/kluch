<?php

namespace wbp\uploadifive;

use wbp\images\models\Image;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class DeleteAction extends \yii\base\Action {

    public function run() {

        $id=(int)Yii::$app->getRequest()->post('id');

        $image=Image::findOne($id);
        if($image->id){
            $image->delete();
        }

    }


}
