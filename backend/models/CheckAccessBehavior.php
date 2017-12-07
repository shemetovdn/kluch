<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/18/2015
 * Time: 15:57
 */

namespace backend\models;


use yii\base\Behavior;

class CheckAccessBehavior extends Behavior
{

    public $attribute;

    public function checkAccess($store_id){
        foreach($this->owner->{$this->attribute} as $num=>$store){
//            echo $store->id;
            if($store->id==$store_id) return true;
        }
        return false;
    }

}