<?php

namespace backend\modules\adverts\models;

use backend\modules\adverts\models\ObjectTypes;
use common\models\WbpActiveRecord;
use yii\helpers\Url;
use backend\modules\categories\models\Category;
use common\models\User;


class Apartment extends WbpActiveRecord
{

    public static $seoKey = 'adverts';
    public static $imageTypes = ['adverts'];
    public static $videoTypes = ['video'];
    protected $arrayPars=['furniture_ids', 'comfort_ids'];

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
                'reserve'

            ], 'safe', 'on' => [self::ADMIN_ADD_SCENARIO, self::ADMIN_EDIT_SCENARIO]],
            [['title', 'status', 'price', 'total_area','price_dollar','price_euro', ], 'required', 'message' => 'Это обязательное поле', 'on' => [WbpActiveRecord::ADMIN_ADD_SCENARIO, WbpActiveRecord::ADMIN_EDIT_SCENARIO]],
            [['price', 'kitchen', 'living_space', 'total_area', 'deposit','price_dollar','price_euro', 'floor', 'total_floor'], 'integer', 'message' => 'Введите число'],
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
            'address' => \Yii::t('admin', 'Адрес'),
            'object_type_id' => \Yii::t('admin', 'Тип Объекта'),
            'price' => \Yii::t('admin', 'Цена (в рублях)'),
            'price_dollar' => \Yii::t('admin', 'Цена (в долларах)'),
            'price_euro' => \Yii::t('admin', 'Цена (в Евро)'),
            'total_area' => \Yii::t('admin', 'Общая площадь'),
            'living_space' => \Yii::t('admin', 'Жилая площадь'),
            'balcones_id' => \Yii::t('admin', 'Балконы'),
            'exclusive' => \Yii::t('admin', 'Эксклюзивная продажа'),
            'kitchen' => \Yii::t('admin', 'Площадь кухни'),
            'furniture_ids' => \Yii::t('admin', 'Мебель'),
            'comfort_ids' => \Yii::t('admin', 'Удобства'),
            'windows' => \Yii::t('admin', 'Окна'),
            'lift' => \Yii::t('admin', 'Лифт'),
            'comfort' => \Yii::t('admin', 'Удобства'),
            'deposit' => \Yii::t('admin', 'Задаток  (в рублях)'),
            'prepayment_id' => \Yii::t('admin', 'Предоплата (месяцев)'),
            'reserve' => \Yii::t('admin', 'Зарезервировано'),
        ];
    }

//    public function __get($name)
//    {
//        $haystack = ['title', 'description', 'moisture', 'purity', 'test_weight', 'grain_admixture', 'min_order', 'packing'];
//        if (in_array($name, $haystack) && \Yii::$app->language == 'ru-RU'
//            && \Yii::$app->id != 'app-backend') {
//            $name = $name . '_ru';
//        }
//
//        return parent::__get($name); // TODO: Change the autogenerated stub
//    }


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
        return $this->hasOne(ObjectTypes::className(), ['object_type_id' => 'id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'rooms_id']);
    }
    public function getCity()
    {
        return $this->hasOne(\backend\modules\regions\models\Regions::className(), ['id' => 'city_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {


        return parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }


}