<?php

namespace backend\modules\mailTemplates\models;

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

        $query=$this->getOrder($query);

        if(Yii::$app->user->identity->is_super_admin != 1){
            $query->andWhere(['<>','store_id', -1]);
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
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