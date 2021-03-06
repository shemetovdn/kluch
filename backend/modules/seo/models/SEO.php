<?php
namespace backend\modules\seo\models;

use common\models\WbpActiveRecord;
use wbp\images\models\PlaceHolder;
use Yii;


/**
 * Class SEO
 * @package backend\modules\seo\models
 */
class SEO extends WbpActiveRecord
{
    public static $preset=[];

    /**
     * @var
     */
    public $weeks_adm;
    /**
     * @var array
     */
    public static $imageTypes = ['og:image'];

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%seo}}'; // TODO: Change the autogenerated stub
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('admin', 'title'),
            'description' => Yii::t('admin', 'description'),
            'keywords' => Yii::t('admin', 'keywords'),
            'status' => Yii::t('admin', 'status'),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'status', 'og_title', 'og_description', 'og_url', 'og_type', 'sort'], 'safe', 'on' => [self::ADMIN_ADD_SCENARIO, self::ADMIN_EDIT_SCENARIO]],
        ];
    }

    /**
     * @param $key
     * @param bool $create
     * @return $this|array|SEO|null|\yii\db\ActiveRecord
     */
    public static function findByKey($key, $create = true)
    {
        $seoModel = self::find()->where(['key' => $key]);
        if (!$create) $seoModel = $seoModel->andWhere(['status' => 1]);
        $seoModel = $seoModel->one();
        if (!$seoModel && $create) {
            $seoModel = new self();
            $seoModel->key = $key;
            $seoModel->save();
        }
        return $seoModel;
    }

    /**
     * @param $key
     */
    public static function setByKey($key, $object=false)
    {
        $model = self::findByKey($key);
        $default = self::findByKey('default');
        if ($model) {
            self::setMeta($model, $default, $object);
        }
    }

    /**
     * @param $model
     * @return bool
     */
    public static function setByModel($model)
    {
        $className = $model->className();
        $key = $className::$seoKey;
        if (!$key) return false;
        $key = $key . '-' . $model->id;
        self::setByKey($key, $model);
    }


    /**
     * @param $seo
     * @param $default
     */
    public static function setMeta($seo, $default, $model=false)
    {
        $properties=[
            'description'=>'setDescription',
            'keywords'=>'setKeywords',
            'title'=>'setTitle',
            'og_title'=>'setOgTitle',
            'og_description'=>'setOgDescription',
            'og_type'=>'setOgType',
            'og_url'=>'setOgUrl',
        ];

        $attributes=$model->getAttributes();

        foreach ($properties as $property=>$method){
            $base_property=str_replace('og_','', $property);
            if ($seo->{$property})
                call_user_func([self::className(),$method],$seo->{$property});
            elseif (
                $model &&
                (
                    isset($attributes[$property]) ||
                    method_exists($model,'get'.ucfirst($property))
                ) &&
                $model->{$property}
            ) call_user_func([self::className(),$method],mb_substr(strip_tags($model->{$property}), 0, 200));
            elseif (
                ($property=='og_title' || $property=='og_description') &&
                $model &&
                (
                    isset($attributes[$base_property]) ||
                    method_exists($model,'get'.ucfirst($base_property))
                ) &&
                $model->{$base_property}
            ) call_user_func([self::className(),$method],mb_substr(strip_tags($model->{$base_property}), 0, 200));
            elseif ($default->{$property}) call_user_func([self::className(),$method],$default->{$property});
        }

        // image isset and it is'nt "noimage"
        if(isset($seo->image) && !($seo->image instanceof PlaceHolder)){
            self::setOgImage($seo->image->getAbsoluteSourceUrl());
        }
    }


    /**
     * @param $ogTitle
     */
    public static function setOgTitle($ogTitle)
    {
        self::$preset['og:title']=self::prepareContent($ogTitle);
    }

    /**
     * @param $description
     */
    public static function setOgDescription($description)
    {
        self::$preset['og:description']=self::prepareContent($description);
    }

    /**
     * @param $type
     */
    public static function setOgType($type)
    {
        self::$preset['og:type']=self::prepareContent($type);
    }


    /**
     * @param $url
     */
    public static function setOgUrl($url)
    {
        self::$preset['og:url']=self::prepareContent($url);
    }


    /**
     * @param $image
     */
    public static function setOgImage($image)
    {
        self::$preset['og:image']=self::prepareContent($image);
    }



    /**
     * @param $keywords
     */
    public static function setKeywords($keywords)
    {
        self::$preset['keywords']=self::prepareContent($keywords);
    }


    /**
     * @param $description
     */
    public static function setDescription($description)
    {
        self::$preset['description']=self::prepareContent($description);
    }

    /**
     * @param $title
     */
    public static function setTitle($title)
    {
        \Yii::$app->view->title = self::prepareContent($title);
    }

    /**
     * @param $content
     * @return mixed
     */
    public static function prepareContent($content)
    {
        return str_replace([
            "\r\n", "\n", "\r"
        ], ' ', strip_tags($content));
    }

    public static function setMetaTags(){
        foreach (self::$preset as $key=>$value){

            \Yii::$app->view->registerMetaTag([
                'property' => $key,
                'content' => $value
            ]);
        }
    }

}