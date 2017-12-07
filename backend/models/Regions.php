<?php
namespace backend\models;

use common\models\WbpActiveRecord;

class Regions extends WbpActiveRecord
{

    public static function tableName()
    {
        return '{{%region}}';
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'code'
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['country_id' => 'id']);
    }

    public static function getStateList($country)
    {
        $key = 'id';
        $value = 'title';
        $sort = 'title';

        $result = [];
        $items = self::find()->where(['country_id' => $country])->orderBy($sort)->asArray()->all();
        foreach ($items as $item) {
            $result[$item[$key]] = $item[$value];//.'&nbsp;';
            //$result[$item[$key]]=mb_strtolower($item[$value]);//.'&nbsp;';
        }
        return $result;
    }

    public static function getStateJsonToFile()
    {
        $key = 'id';
        $value = 'title';
        $sort = 'id';

        $result = [];
        $items = self::find()->orderBy($sort)->asArray()->all();
        foreach ($items as $item) {
            $result[$item[$key]] = $item;//.'&nbsp;';
            //$result[$item[$key]]=mb_strtolower($item[$value]);//.'&nbsp;';
        }
        return $result;
    }

    public function __toString()
    {
        return $this->title;
    }


}