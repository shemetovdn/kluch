<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 02.06.2015
 * Time: 15:27
 */

namespace wbp\formatter;

class Formatter extends \yii\i18n\Formatter{

    public function asHourMinutesSeconds($value){
        $result='';
        $h=floor($value/3600);
        $m=floor(($value-$h*3600)/60);
        $s=$value-$h*3600-$m*60;
        if($h) $result.=$h.'hrs ';
        if($m) $result.=$m.'min ';
        if($s) $result.=$s.'sec ';
        return trim($result);
    }

}