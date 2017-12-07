<?php

namespace backend\modules\pages\models;

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
        $order,$language_id;

    public function rules()
    {
        return [
            [['order','language_id','search'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find()->orderBy('sort');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination'=>[
                'pageSize' => 50
            ]
        ]);

        $query=$this->getOrder($query);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->language_id!=''){
            $query=$query->andWhere(['language_id'=>$this->language_id]);
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