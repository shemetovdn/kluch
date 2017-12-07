<?php

namespace wbp\eStoreApi\system\models;

use yii\base\Model;

class Regions extends Model
{
    public $id, $title, $code;

    /**
     * @var palced in wbp/jsonFiles/state.json
     */
    const JSON_FILE_PATH = '/jsonFiles/state.json';

    public function rules()
    {
        return [
            [['id', 'title', 'code'], 'safe'],
        ];
    }

    public function __toString()
    {
        if ($this->code) return (string)$this->code;
        return (string)$this->title;
    }

    static public function getRegionsListFromJson($countryId = 22) // 22 Usa
    {
        $path = \Yii::getAlias('@wbp') . self::JSON_FILE_PATH;
        $data = (array)json_decode(file_get_contents($path));
        $return = array();
        foreach ($data as $v) {
            if ($v->country_id != $countryId) {
                continue;
            }
            $return[] = ['id' => $v->id, 'name' => $v->title];
        }

        return $return;
    }

    static public function getRegionsTitleById($stateId)
    {
        $path = \Yii::getAlias('@wbp') . self::JSON_FILE_PATH ;
        $data = json_decode(file_get_contents( $path ), true);
        if($data[$stateId]) return $data[$stateId][title];
        return false;
    }

}