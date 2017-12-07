<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 11.11.2015
 * Time: 14:47
 */
namespace wbp\helpers;
use common\models\Config;
use Yii;
use yii\helpers\StringHelper;
use yii\helpers\Url;

class MetaPropertySocialSetter {
    public static $shortDesc,$model,$imageType;

    public static function setMeta($model,$imageType,$description='',$title=''){
        self::$model = $model;
        if(!$description) $description = self::$model->description;
        if(!$title) $title = self::$model->title;
        if(filter_var($imageType, FILTER_VALIDATE_URL) === false){
            $image = self::$model->getImage($imageType)->getAbsoluteUrl();
        }else {
            $image = $imageType;
        }
        self::$shortDesc = trim(preg_replace('/\s+/', ' ',StringHelper::truncate(self::strip_html_tags($description),500,'...',null,true)));
        self::facebook($title,'company',Url::to('',true),$image,self::$shortDesc);
        self::googlePlus($title,self::$shortDesc);
    }

    public static function facebook($title,$company = 'company',$url,$image,$description){
        Yii::$app->view->registerMetaTag(['property'=>'og:title','content'=>$title]);
        Yii::$app->view->registerMetaTag(['property'=>'og:type','content'=>$company]);
        Yii::$app->view->registerMetaTag(['property'=>'og:url','content'=>$url]);
        Yii::$app->view->registerMetaTag(['property'=>'og:image','content'=>$image]);
        Yii::$app->view->registerMetaTag(['property'=>'og:site_name','content'=>Config::getParameter('title')]);
        Yii::$app->view->registerMetaTag(['property'=>'og:description','content'=>$description]);
        Yii::$app->view->registerMetaTag(['property'=>'og:locale','content'=>Yii::$app->language]);
    }

    public static function googlePlus($title,$description){
        Yii::$app->view->registerMetaTag(['itemprop'=>'name','content'=>$title]);
        Yii::$app->view->registerMetaTag(['itemprop'=>'description','content'=>$description]);
    }

    public static function  strip_html_tags($str){
        $str = preg_replace('/(<|>)\1{2}/is', '', $str);
        $str = preg_replace(
            array(// Remove invisible content
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
                ),
            "", //replace above with nothing
            $str );
        $str = trim(strip_tags($str));
    return $str;
}
}


