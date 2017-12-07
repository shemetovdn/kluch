<?php

namespace backend\modules\agents\models;

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
            [['order','from','to','search'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        if (!\Yii::$app->user->identity->is_super_admin) {
            $query = $query->andWhere(['id' => \Yii::$app->user->identity->merchantIds]);
        }

        $query=$this->getOrder($query);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if($this->from!=''){
            $query=$query->andWhere(['>', '{{%user}}.created_at', date("Y-m-d H:i:s",strtotime($this->from))]);
        }

        if($this->to!=''){
            $query=$query->andWhere(['<', '{{%user}}.created_at', date("Y-m-d H:i:s",strtotime($this->to))]);
        }

        if($this->search!=''){
            $query=$query->andWhere("
                (
                    {{%user}}.username like :title OR
                    {{%user}}.email like :title OR
                    {{%user_data}}.phone like :title OR
                    {{%user}}.id like :title
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