<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 06.04.2016
 **** Time: 17:11
 */

namespace backend\models;


use common\models\WbpActiveRecord;

class CreditCardTypes extends WbpActiveRecord
{


    public static function tableName()
    {
        return '{{%card_types}}';
    }
}