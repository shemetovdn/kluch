<?php

namespace wbp\images\models;

use common\models\WbpActiveRecord;


class ImageSizes extends WbpActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%images_sizes}}';
    }
}
