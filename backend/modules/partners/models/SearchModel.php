<?php
namespace backend\modules\partners\models;

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

        $query=$this->getOrder($query);

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