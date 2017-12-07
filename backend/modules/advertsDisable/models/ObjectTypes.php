<?php

namespace backend\modules\adverts\models;

use backend\modules\categories\models\Category;
use common\models\WbpActiveRecord;
use yii\helpers\Url;


class ObjectTypes extends WbpActiveRecord
{

    public static $seoKey = 'adverts';
    public static $imageTypes = ['adverts'];

    public static function tableName()
    {
        return '{{%object_types}}';
    }

    public static function findById($id){

//        echo 'sdffsadfasdfsadfsadfsadfsadf     -> ';
//        echo $id;
//        exit();
        return self::find()->where(['id'=>$id])->one();

    }


}