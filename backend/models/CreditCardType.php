<?php
namespace backend\models;

use backend\modules\stores\models\Stores;
use common\models\WbpActiveRecord;

class CreditCardType extends WbpActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%card_types}}';
    }


    /**
     * check access to this address from current store
     * @return bool
     */
    public static function checkAccess(){
        return true;
    }


}
