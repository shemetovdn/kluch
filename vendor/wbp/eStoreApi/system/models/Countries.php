<?php

namespace wbp\eStoreApi\system\models;

use yii\base\Model;

class Countries extends Model{
    static public $countries=[];

    public $id,$title,$code,$sort,$regions=[];

    const JSON_FILE_PATH = '/jsonFiles/countries.json';

    public function rules()
    {
        return [
            [['id','title','code','sort'],'safe'],
        ];
    }

    static public function getCountryById($id, $cache=true){
        if(self::$countries[$id] && $cache) return self::$countries[$id];

        $data=\Yii::$app->eStore->get('countries/'.(int)$id);
        if($data){
            $country=new Countries();
            $country->setData($data);
            self::$countries[$id]=$country;
            return self::$countries[$id];
        }else{
            return false;
        }
    }

    static public function getCountries(){
        $result=[];
        $data=\Yii::$app->eStore->get('countries');

        if($data){
            foreach($data as $countryData){
                $country=new Countries();
                $country->setData($countryData);
                $result[$country->id]=$country;
            }
            return $result;
        }else{
            return false;
        }
    }

    static public function getCountriesList(){
        $countries=self::getCountries();
        $result=[];
        foreach((array)$countries as $country){
            $result[$country->id]=$country->title;
        }
        return $result;
    }

    public function setData($data){
        $this->load($data,'');
    }

    public function getRegions(){
        $data=\Yii::$app->eStore->get('countries/'.$this->id.'?expand=regions');

        if($data['regions']) {
            foreach ($data['regions'] as $regionData) {
                $region = new Regions();
                $region->load($regionData,'');
                $this->regions[$region->id] = $region;
            }
        }

        return $this->regions;
    }

    public function getRegionsList(){
        $regions=$this->getRegions();
        $result=[];
        foreach($regions as $region){
            $result[$region->id]=$region->title;
        }
        return $result;
    }

    static public function getCountriesListFromJson()
    {
        $path = \Yii::getAlias('@wbp') . self::JSON_FILE_PATH ;
        $data = (array)json_decode(file_get_contents( $path ));
        return $data;
    }

    static public function getCountriesTitleById($countryId)
    {
        $path = \Yii::getAlias('@wbp') . self::JSON_FILE_PATH ;
        $data = json_decode(file_get_contents( $path ), true);
        if($data[$countryId]) return $data[$countryId];
        return false;
    }

    public function __toString(){
        return $this->title;
    }
}