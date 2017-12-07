<?php

namespace backend\modules\orderPropertyManagment\models;


use backend\models\BaseSearchModel;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Login form
 */
class SearchModel extends BaseSearchModel
{
    public $from;
    public $to;
    public $search;
    public $language_id;
    public $order;
    public $tableName = '{{%contact}}';

    public function rules()
    {
        return [
            [['order', 'from', 'to', 'search', 'language_id'], 'safe']
        ];
    }

    public function search($modelName,$params)
    {
        $query = $modelName::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->from!=''){
            $query=$query->andWhere(['>', "$this->tableName.created_at", date("Y-m-d H:i:s",strtotime($this->from))]);
        }

        if($this->to!=''){
            $query=$query->andWhere(['<', "$this->tableName.created_at", date("Y-m-d H:i:s",strtotime($this->to))]);
        }

        if($this->language_id!=''){
            $query=$query->andWhere(['language_id'=>$this->language_id]);
        }

        if($this->search!=''){
            $query=$query->andWhere("
                (
                    $this->tableName.title like :title OR
                    $this->tableName.description like :title OR
                )",[':title'=>'%'.$this->search.'%']);
        }

        $query=$this->getOrder($query);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'from'       =>  Yii::t('admin', 'Added From:'),
            'to'         =>  Yii::t('admin', 'Added To:'),
            'order'      =>  Yii::t('admin', 'Sort By:'),
            'language_id'=>  Yii::t('admin', 'Language:'),
        ];
    }
}