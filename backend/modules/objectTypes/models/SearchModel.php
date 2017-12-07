<?php

namespace backend\modules\objectTypes\models;

use backend\models\BaseSearchModel;
use yii\data\ActiveDataProvider;

class SearchModel extends BaseSearchModel
{
    public $from,
        $to,
        $search,
        $order;

    public function rules()
    {
        return [
            [['order', 'from', 'to', 'search'], 'safe']
        ];
    }

    public function search($modelName, $params)
    {
        $query = $modelName::find();

        if (!\Yii::$app->user->identity->is_super_admin) {
            $query = $query->andWhere(['user_id' => \Yii::$app->user->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);

        $query = $this->getOrder($query);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'from' => 'Added From:',
            'to' => 'Added To:',
            'order' => \Yii::t('admin', 'Sort By:'),
        ];
    }
}