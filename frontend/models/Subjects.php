<?php

namespace frontend\models;

use common\models\WbpActiveRecord;


class Subjects extends WbpActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{%contact_subjects}}';
    }
}
