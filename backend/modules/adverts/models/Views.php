<?php

namespace backend\modules\adverts\models;

use common\models\WbpActiveRecord;


class Views extends WbpActiveRecord
{
    public static function tableName()
    {
        return '{{%views}}';
    }
}