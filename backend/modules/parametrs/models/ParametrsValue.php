<?php
namespace backend\modules\parametrs\models;

use backend\models\Modules;
use common\models\UserData;
use common\models\WbpActiveRecord;
use Yii;


/**
 * @property int $id
 * @property int $title
 * @property int $key
 * @property int $url
 */
class ParametrsValue extends WbpActiveRecord
{
    public static function tableName()
    {
        return '{{%parametrs_value}}';
    }
}
