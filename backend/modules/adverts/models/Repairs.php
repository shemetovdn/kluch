<?php

namespace backend\modules\adverts\models;

use backend\modules\categories\models\Category;
use common\models\WbpActiveRecord;
use yii\helpers\Url;


class Repairs extends WbpActiveRecord
{

    public static $seoKey = 'adverts';
    public static $imageTypes = ['adverts'];

    public static function tableName()
    {
        return '{{%repairs}}';
    }


}