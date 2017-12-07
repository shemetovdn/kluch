<?php

namespace backend\modules\adverts\models;

use backend\modules\categories\models\Category;
use common\models\WbpActiveRecord;
use yii\helpers\Url;


class AdvertsParametrs extends WbpActiveRecord
{

    public static $seoKey = 'adverts';
    public static $imageTypes = ['adverts'];

    public static function tableName()
    {
        return '{{%adverts_parametrs}}';
    }

    public static function getAdvertsByArea($area_from = false, $area_to = false){

        $query = AdvertsParametrs::find()->where(['parametr_id'=>13]);
        if(!empty($area_from)){
            $query->andWhere(['>=', 'value', $area_from+ 0]);
            $myQuery = 'select * from wbp_adverts_parametrs where 
( 
  (parametr_id="13 AND "  ) 
) 
';
        }
        if(!empty($area_to)){
            $query->andWhere(['<=', 'value', $area_to+ 0]);
        }

        $request = $query->all();

        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
        return $adverts_ids;
    }

    public static function getAdvertsByText($param_id, $from = false, $to = false){

        $query = AdvertsParametrs::find()->where(['parametr_id'=>$param_id]);
        if(!empty($from)){
            $query->andWhere(['>=', 'value', $from+ 0]);

        }
        if(!empty($to)){
            $query->andWhere(['<=', 'value', $to+ 0]);
        }

        $request = $query->all();

        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
        return $adverts_ids;
    }

    public static function getAdvertsByFloor($floor_from = false, $floor_to = false){

        $query = AdvertsParametrs::find()->where(['parametr_id'=>15]);
        if(!empty($floor_from)){
            $query->andWhere(['>=', 'value', $floor_from+ 0]);
        }
        if(!empty($floor_to)){
            $query->andWhere(['<=', 'value', $floor_to+ 0]);
        }
        $request = $query->all();
        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
//echo "<pre>";var_dump($request);exit;
        return $adverts_ids;
    }

    public static function getAdvertsByFurniture($floor_from = false, $floor_to = false){

        $query = AdvertsParametrs::find()->where(['parametr_id'=>15]);
        if(!empty($floor_from)){
            $query->andWhere(['>=', 'value', $floor_from+ 0]);
        }
        if(!empty($floor_to)){
            $query->andWhere(['<=', 'value', $floor_to+ 0]);
        }
        $request = $query->all();
        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
//echo "<pre>";var_dump($request);exit;
        return $adverts_ids;
    }

    public static function getAdvertsById($id, $parametr_id){
        $query = AdvertsParametrs::find()->where(['parametr_id'=>$parametr_id]);
        if(!empty($id)){
            $query->andWhere(['value'=>$id + 0]);
        }
        $request = $query->all();
        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
        return $adverts_ids;
    }

    public static function getAdvertsByIds($ids, $parametr_id){
        $query = AdvertsParametrs::find()->where(['parametr_id'=>$parametr_id]);
        if(!empty($ids)){
            $query->andWhere(['value_id'=>$ids]);
        }
        $request = $query->all();
        $adverts_ids = array();
        foreach ($request as $key => $value){
            $adverts_ids[] = $value->advert_id;
        }
        return $adverts_ids;
    }


}