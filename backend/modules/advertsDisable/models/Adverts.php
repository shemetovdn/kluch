<?php

namespace backend\modules\advertsDisable\models;

use backend\modules\adverts\models\ObjectTypes;
use common\models\WbpActiveRecord;
use yii\helpers\Url;
use backend\modules\categories\models\Category;
use common\models\User;
use backend\modules\adverts\models\AdvertsParametrs;
use yii;


class Adverts extends WbpActiveRecord
{

    public static $seoKey = 'adverts';
    public static $imageTypes = ['adverts', 'advertsVideoPrev'];
    public static $videoTypes = ['video'];

    public static function tableName()
    {
        return '{{%adverts}}';
    }

    public function rules()
    {
        return [
            [[
                'title',
                'description',
                'href',
                'status',
                'category_id',
                'city_id',
                'address',
                'object_type_id',
                'rooms_id',
                'total_area',
                'living_space',
                'balcones_id',
                'floor',
                'building_type_id',
                'lift',
                'windows',
                'repairs_id',
                'furniture_ids',
                'comfort_ids',
                'nearness_id',
                'deposit',
                'prepayment_id',
                'user_id',
                'price',
                'lat',
                'lng',
                'kitchen',
                'date',
                'exclusive',
                'price_dollar',
                'price_euro',
                'cadastral_number',
                'loggia_id',
                'reserve',
                'note',
                'price_per_meter',
                'views',
                'month_price'

            ], 'safe', 'on' => [self::ADMIN_ADD_SCENARIO, self::ADMIN_EDIT_SCENARIO]],
            [['title', 'status', 'price', 'city_id',], 'required', 'message' => 'Это обязательное поле', 'on' => [WbpActiveRecord::ADMIN_ADD_SCENARIO, WbpActiveRecord::ADMIN_EDIT_SCENARIO]],
            [['price', 'deposit','price_dollar','price_euro',], 'integer', 'message' => 'Введите число'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => \Yii::t('admin', 'title'),
            'title_ru' => \Yii::t('admin', 'title'),
            'href' => \Yii::t('admin', 'href'),
            'description' => \Yii::t('admin', 'description'),
            'description_ru' => \Yii::t('admin', 'description'),
            'status' => \Yii::t('admin', 'status'),
            'parent' => \Yii::t('admin', 'parent'),
            'moisture' => \Yii::t('admin', 'moisture'),
            'moisture_ru' => \Yii::t('admin', 'moisture'),
            'purity' => \Yii::t('admin', 'purity'),
            'purity_ru' => \Yii::t('admin', 'purity'),
            'test_weight' => \Yii::t('admin', 'test_weight'),
            'test_weight_ru' => \Yii::t('admin', 'test_weight'),
            'grain_admixture' => \Yii::t('admin', 'grain_admixture'),
            'grain_admixture_ru' => \Yii::t('admin', 'grain_admixture'),
            'min_order' => \Yii::t('admin', 'min_order'),
            'min_order_ru' => \Yii::t('admin', 'min_order'),
            'packing' => \Yii::t('admin', 'packing'),
            'floor' => \Yii::t('admin', 'Этаж'),
            'total_floor' => \Yii::t('admin', 'Всего этажей'),
            'category_id' => \Yii::t('admin', 'Category'),
            'building_type_id' => \Yii::t('admin', 'Тип здания'),
            'nearness_id' => \Yii::t('admin', 'Близость к морю'),
            'repairs' => \Yii::t('admin', 'Ремонт'),
            'city_id' => \Yii::t('admin', 'Город'),
            'address' => \Yii::t('admin', 'Улица'),
            'object_type_id' => \Yii::t('admin', 'Тип Объекта'),
            'price' => \Yii::t('admin', 'Цена (в рублях)'),
            'price_dollar' => \Yii::t('admin', 'Цена (в долларах)'),
            'price_euro' => \Yii::t('admin', 'Цена (в Евро)'),
            'total_area' => \Yii::t('admin', 'Общая площадь'),
            'living_space' => \Yii::t('admin', 'Жилая площадь'),
            'balcones_id' => \Yii::t('admin', 'Балконы'),
            'exclusive' => \Yii::t('admin', 'Эксклюзивный статус'),
            'kitchen' => \Yii::t('admin', 'Площадь кухни'),
            'furniture_ids' => \Yii::t('admin', 'Мебель'),
            'comfort_ids' => \Yii::t('admin', 'Удобства'),
            'windows' => \Yii::t('admin', 'Окна'),
            'lift' => \Yii::t('admin', 'Лифт'),
            'comfort' => \Yii::t('admin', 'Удобства'),
            'deposit' => \Yii::t('admin', 'Задаток  (в рублях)'),
            'prepayment_id' => \Yii::t('admin', 'Предоплата (месяцев)'),
            'reserve' => \Yii::t('admin', 'Зарезервировано'),
            'price_per_meter' => \Yii::t('admin', 'Цена Кв.м'),
        ];
    }

    public function addStatistic(){
        $session_id=Yii::$app->session->getId();
        $advert_id=$this->id;

        $view=Views::find()->where([
            'session_id'=>$session_id,
            'advert_id'=>$advert_id
        ])->andWhere(['>=','created_at',time()-24*3600]);

        if(!$view->count()){
            $view=new Views();
            $view->session_id=$session_id;
            $view->advert_id=$advert_id;
            $view->save();
        }
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


    public function getUrl($absolute = false)
    {
        return Url::to(['adverts/view', 'href' => $this->href], $absolute);
    }

    public function hasChildren()
    {
        return $this->getChildren()->count();
    }

    public function getChildren()
    {
        return self::find()->where(['status' => 1, 'parent' => $this->id])->orderBy(['sort' => SORT_ASC]);
    }
    public function getObjectType()
    {
        return $this->hasOne(ObjectTypes::className(), ['id' => 'object_type_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAgent()
    {
        return $this->hasOne(\backend\modules\agents\models\Agents::className(), ['id' => 'user_id']);
    }

    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'rooms_id']);
    }
    public function getCity()
    {
        return $this->hasOne(\backend\modules\regions\models\Regions::className(), ['id' => 'city_id']);
    }

    public function getPrepayment()
    {
        return $this->hasOne(\backend\modules\adverts\models\Prepayments::className(), ['id' => 'prepayment_id']);
    }
    public function getParams(){

        $params = AdvertsParametrs::find()->where(['advert_id'=>$this->id])->all();
$arrayPar = [];

        foreach($params as $key =>$value){
            $arrayPar[$value["parametr_id"]] = $value["value"];
        }
        return $arrayPar;
    }
    public function getRoom(){
        $param_value ='';
        $param = AdvertsParametrs::find()->where(['advert_id'=>$this->id, 'parametr_id' => 2])->asArray()->one();
       if(!empty($param['value'])){
           $param_value = \backend\modules\parametrs\models\ParametrsValue::findOne($param['value'])->value;

       }

        return $param_value;
    }

    public function getParametr($id){
        $param_value ='';
        $param = AdvertsParametrs::find()->where(['advert_id'=>$this->id, 'parametr_id' => $id])->asArray()->one();

        if($param){
            if($param['field_type_id'] == 3){
                $param_value = $param['value'];
            }elseif($param['field_type_id'] == 1 && !empty($param['value_id'])){
                $param_value = \backend\modules\parametrs\models\ParametrsValue::findOne($param['value_id'])->value;
            }elseif($param['field_type_id'] == 2){
                $ids = explode(',', $param['value']);
                $parametrs = \backend\modules\parametrs\models\ParametrsValue::find()->where(['id' => $ids])->all();
                $param_value = array();
                foreach($parametrs as $key => $value){
                    $param_value[] = $value->value;
                }
            }
        }


        return $param_value;
    }

    public static function getMarkers(){
        $totaladverts = Adverts::find()->where(['status'=>1])->all();
        $totaladverts_array = array();
        foreach($totaladverts as $key => $value){
            $images = array();
            foreach ($value->images as $img_index=>$img){
                $images[] = $img->getUrl(320, 320);
            }
            $totaladverts_array[] = array(
                'id'=>$value->id,
                'href'=>$value->getUrl(),
                'title'=>$value->title,
                'price'=>$value->price,
                'address'=>$value->address,
                'lat'=>$value->lat,
                'lng'=>$value->lng,
                'images'=>$images,
            );
        }
        return $totaladverts_array;
    }

    public function afterDelete()
    {
        $param_del = AdvertsParametrs::find()->where(['advert_id'=>$this->id])->all();
        foreach($param_del as $param){
            $param->delete();
        }

        parent::afterDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $parametrs = Yii::$app->request->post("Adverts")["parametrs"];
//        echo "<pre>";var_dump($parametrs);exit;

        if(isset($parametrs)&&is_array($parametrs)){
            $param_del = AdvertsParametrs::find()->where(['advert_id'=>$this->id])->all();
            foreach($param_del as $param){
                $param->delete();
            }
            foreach($parametrs as $key =>$value){

                foreach ($value as $param_id =>$param_value){
                    if(!empty($param_value)){
                        $param = new AdvertsParametrs();
                        $param->advert_id = $this->id;
                        $param->parametr_id = $param_id;
                        $param->field_type_id = $key;
                        if(is_array($param_value)){
                            $param_value = implode(',',$param_value);
                            $param->value = $param_value;
                        }elseif ($key == 3&& $param_value!= ''){
                            $param->value = $param_value;
                        }elseif($key == 1){
                            $param->value_id = $param_value;
                        }
                        $param->value = $param_value;

                        $param->save();
                    }

                }
            }
        }

        return parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
    public static function getSimularPrice($price, $id){
        $query = Adverts::find()->where(['status'=>1])->andWhere(['!=', 'id', $id]);
        if(!empty($price)){
            $price_minus = $price * \common\models\Config::getParameter('price_minus') / 100;
            $price_plus = $price * \common\models\Config::getParameter('price_plus') / 100;
            $query
                    ->andWhere(['>=', 'price', $price - $price_minus])
                    ->andWhere(['<=', 'price', $price + $price_plus])
            ;
        }

        $adverts = $query->all();

        $ids = array();
        foreach ($adverts as $value){
            $ids[] = $value->id;
        }
        return $ids;
    }
    public static function getSimularArea($size, $object_type_id){

        $query = AdvertsParametrs::find();

        if($object_type_id == 4 || $object_type_id == 5){
            $query = $query->where(['parametr_id'=>21]);
        }elseif($object_type_id == 6){
            $query = $query->where(['parametr_id'=>19]);
        }else{
            $query = $query->where(['parametr_id'=>13]);
        }

        if(!empty($size)){
            $area_minus = $size * \common\models\Config::getParameter('area_minus') / 100;
            $area_plus = $size * \common\models\Config::getParameter('area_plus') / 100;

if($object_type_id != 6){
    $query = $query
        ->andWhere(['>=', 'value', $size- $area_minus])
        ->andWhere(['<=', 'value', $size+ $area_plus]);
}else{
    $query = $query
        ->andWhere(['>=', 'value', $size- $area_minus])
        ->andWhere(['<=', 'value', $size+ $area_plus]);
}
        }
        $adverts = $query->all();

        $ids = array();
        foreach ($adverts as $value){
            $ids[] = $value->advert_id;
        }
        return $ids;
    }

}