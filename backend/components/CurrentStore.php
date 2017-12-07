<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 08.10.2015
 **** Time: 14:16
 */

namespace backend\components;


use backend\modules\stores\models\Stores;
use yii\base\Component;

class CurrentStore extends Component
{
    protected $storeId;

    public function init()
    {
        $this->storeId=\Yii::$app->session->get('store_id');
        return parent::init();
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getStore(){
        return Stores::findOne(['id'=>$this->storeId]);
    }

    public function setStoreId($_storeId)
    {
        $this->storeId = $_storeId;
        \Yii::$app->session->set('store_id', $this->storeId);
    }

}