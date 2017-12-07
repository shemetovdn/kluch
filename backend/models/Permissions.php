<?php

namespace backend\models;

use common\models\WbpActiveRecord;


class Permissions extends WbpActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%permission}}';
    }

}
