<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 15.01.2015
 * Time: 11:17
 */

namespace wbp\lang;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class Lang extends Component{

    public $languages,$languagesUrls;
    public $current = null;

    public function getLanguagePrefix(){
        $langPrefix=$this->languages[Yii::$app->language];
        if($langPrefix) $langPrefix='_'.$langPrefix;

        return $langPrefix;
    }

    //Получение текущего объекта языка
    public function getCurrent()
    {
        if( $this->current === null ){
            $this->current = $this->getDefaultLang();
        }
        return $this->current;
    }

    public function getLanguageUrl($lng){
        $url=$_SERVER['REQUEST_URI'];
        $urlArray=explode('/',$url);
        $lang=$this->getLangByUrl($urlArray[1]);
        if($lang===null){
            if($this->languagesUrls[$lng]){
                $tmp=[''];
                $tmp[]=$this->languagesUrls[$lng];
                if($urlArray[0]=='') unset($urlArray[0]);
                return implode('/',ArrayHelper::merge($tmp,$urlArray));
            }else{
                return $url;
            }
        }else{
            if($this->languagesUrls[$lng]) {
                $urlArray[1] = $this->languagesUrls[$lng];
                return implode('/', $urlArray);
            }else{
                unset($urlArray[1]);
                $result=implode('/', $urlArray);
                if($result=='') $result='/';
                return $result;
            }
        }
        $langs=$this->languages;
    }

    //Установка текущего объекта языка
    public function setCurrent($url = null)
    {
        $language = $this->getLangByUrl($url);
        $this->current = ($language === null) ? $this->getDefaultLang() : $language;
        Yii::$app->language = $this->current;
    }

    //Получения объекта языка по умолчанию
    public function getDefaultLang()
    {
        return array_keys($this->languages)[0];
    }

    //Получения объекта языка по буквенному идентификатору
    public function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = array_search($url, $this->languagesUrls);
            if ( $language === false ) {
                return null;
            }else{
                return $language;
            }
        }
    }

}