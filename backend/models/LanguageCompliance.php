<?php
namespace backend\models;

use backend\modules\pages\models\Pages;
use common\models\WbpActiveRecord;

class LanguageCompliance extends WbpActiveRecord
{

    public static function tableName()
    {
        return '{{%language_compliance}}';
    }

    public function fields(){
        return [
            'id',
            'page_id',
            'pageaset_id',
            'module'
        ];
    }

    public function getPage(){
        return $this->hasOne(Pages::className(), ['pageaset_id'=>'id']);
    }

}

