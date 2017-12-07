<?php
namespace common\models;


use yii\base\Model;

class Config extends Model
{
    public static function getParameter($name, $multilang = false)
    {
        $langPrefix = \Yii::$app->lang->getLanguagePrefix();
        if($multilang == false) $langPrefix = "";
        $confidPar = ConfigPar::findOne(['name' => $name . $langPrefix]);
        if (!$confidPar) return "parameter " . $name . " not found";
        if (!$confidPar->id) {
            $confidPar = ConfigPar::findOne(['name' => $name]);
        }
        return $confidPar->value;
    }

    public static function setParameter($name, $value)
    {
        $confidPar = ConfigPar::findOne(['name' => $name]);
        $confidPar->value = $value;
        $confidPar->save();
    }


}