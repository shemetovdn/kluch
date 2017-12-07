<?php

namespace backend\modules\moduleCreator\models;

use backend\models\BaseSearchModel;
use yii\data\ActiveDataProvider;

/**
 * Login form
 */
class SearchModel extends BaseSearchModel
{
    public $from,
        $to,
        $search,
        $order;

    public function rules()
    {
        return [
            [['search'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find()->with('permissions');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        $query=$this->getOrder($query);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->from!=''){
            $query=$query->andWhere(['>=', 'created_at', date("Y-m-d",strtotime($this->from))." 00:00:00"]);
        }

        if($this->to!=''){
            $query=$query->andWhere(['<=', 'created_at', date("Y-m-d",strtotime($this->to))." 23:59:59"]);
        }

        if($this->search!=''){
            $query=$query->andWhere("
                (
                    title like :title OR
                    id like :title
                )",[':title'=>'%'.$this->search.'%']);
        }



        return $dataProvider;
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