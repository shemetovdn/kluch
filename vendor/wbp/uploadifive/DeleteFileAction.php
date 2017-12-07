<?php

namespace wbp\uploadifive;

use wbp\file\File;
use Yii;

class DeleteFileAction extends \yii\base\Action {

    public function run() {

        $id=(int)Yii::$app->getRequest()->post('id');

        $video=File::findOne($id);
        if($video->id){
            $video->delete();
        }

    }


}
