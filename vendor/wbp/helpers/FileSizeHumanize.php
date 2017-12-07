<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 27.05.2016
 * Time: 11:32
 */

namespace vendor\wbp\helpers;


use yii\base\Exception;

class FileSizeHumanize
{
    public static function  human_filesize($size, $precision = 2) {
        for($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {}
        return round($size, $precision).['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
    }

    public static function calc_size($file,$is_humanize = true,$precision = 2){
        if(!is_file($file)){
            throw new Exception("File \"$file\" not found");
        }
        $size = filesize($file);
        return ($is_humanize) ? self::human_filesize($size) : $size;
    }
}