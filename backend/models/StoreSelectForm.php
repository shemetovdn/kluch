<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 08.10.2015
 **** Time: 12:22
 */

namespace backend\models;

use Yii;
use yii\base\Model;


class StoreSelectForm extends Model
{
    public $store_id;

    public function init()
    {
        $this->store_id = Yii::$app->currentStore->storeId;
        return parent::init();
    }

    public function rules()
    {
        return [
            ['store_id', 'safe'],
        ];
    }

    public function setStore(){
        if($this->store_id || $this->store_id==0){
            Yii::$app->currentStore->storeId=$this->store_id;
            return true;
        }else{
            return false;
        }
    }
}