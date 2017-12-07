<?php

namespace backend\models;

use yii\base\Model;

/**
 * Login form
 */
class BaseSearchModel extends Model
{
    public $from,
        $to,
        $search,
        $order;

    public function rules()
    {
        return [
            [['order','from','to','search'], 'safe']
        ];
    }

    public function getOrder($query){
        if($this->order){
            $query->orderBy($this->order);
        }else {
            if(\Yii::$app->controller->sortEnable())
                $query->orderBy('sort, id desc');
            else
                $query->orderBy('id desc');
        }

        return $query;
    }

    public function attributeLabels()
    {
        return [
            'from'=>'Added From:',
            'to'=>'Added To:',
            'order'=>'Sort By:',
        ];
    }
}