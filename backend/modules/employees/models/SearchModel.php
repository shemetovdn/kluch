<?php

namespace backend\modules\employees\models;

use backend\models\BaseSearchModel;
use common\models\User;
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
        $order;

    public function rules()
    {
        return [
            [['order','from','to','search'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find()
            ->select('{{%user}}.*')
            ->leftJoin('{{%user_data}}', '{{%user_data}}.`user_id` = {{%user}}.`id`')
            ->where(['!=','{{%user}}.id',Yii::$app->user->id])
            ->andWhere(['{{%user}}.parent'=>User::mainUser()])
            ->with('data');

//        print_r($query->one());exit;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

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

        $query=$this->getOrder($query);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'from'=> Yii::t('admin', 'Added From:'),
            'to'=> Yii::t('admin', 'Added To:'),
            'order'=> Yii::t('admin', 'Sort By:'),
            'search'=> Yii::t('admin', 'Search:'),
        ];
    }
}