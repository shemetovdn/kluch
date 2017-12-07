<?php

namespace backend\modules\employeesActivity\models;

use backend\models\BaseSearchModel;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Login form
 */
class SearchModel extends BaseSearchModel
{
    public $from,
        $to,
        $search,
        $order,
        $user_id,
        $additional_options;

    public function rules()
    {
        return [
            [['order','from','to','search','user_id','additional_options'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find()
            ->select('{{%user_log}}.*')
            ->leftJoin('{{%user}}', '{{%user}}.`id` = {{%user_log}}.`user_id`')
            ->leftJoin('{{%user_data}}', '{{%user_data}}.`user_id` = {{%user_log}}.`user_id`');

//        print_r($query->one());exit;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        $query=$this->getOrder($query);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->from!=''){
            $query=$query->andWhere(['>=', '{{%user_log}}.created_at', date("Y-m-d",strtotime($this->from))." 00:00:00"]);
        }

        if($this->to!=''){
            $query=$query->andWhere(['<=', '{{%user_log}}.created_at', date("Y-m-d",strtotime($this->to))." 23:59:59"]);
        }

        if($this->user_id!=''){
            $query=$query->andWhere(['{{%user_log}}.user_id'=>$this->user_id]);
        }

        if($this->additional_options!=''){
            $query=$query->andWhere(['{{%user_log}}.additional_options'=>$this->additional_options]);
        }

        if($this->search!=''){
            $query=$query->andWhere("
                (
                    {{%user}}.username like :title OR
                    {{%user_data}}.first_name like :title OR
                    {{%user_data}}.last_name like :title OR
                    {{%user_log}}.module like :title OR
                    {{%user_log}}.action like :title OR
                    {{%user}}.id like :title
                )",[':title'=>'%'.$this->search.'%']);
        }


        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'from'=> Yii::t('admin', 'From:'),
            'to'=> Yii::t('admin', 'To:'),
            'order'=>Yii::t('admin', 'Sort By:'),
            'additional_options'=> Yii::t('admin', 'Type:'),
            'user_id'=> Yii::t('admin', 'User:'),
            'search'=> Yii::t('admin', 'Search:'),
        ];
    }
}