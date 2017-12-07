<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 03.09.2015
 **** Time: 12:18
 */

namespace backend\models;


class Status
{
    const ACTIVE = 'Active';
    const DEACTIVATED = 'Disabled';
    const ENABLE = 1;
    const DISABLED = 0;


    private static $eyes = [
        Status::ENABLE => 'eye_open btn-info',
        Status::DISABLED => 'eye_close',
    ];


    public static function get($var)
    {
        if ($var == self::ENABLE) {
            return self::ACTIVE;
        } elseif ($var == self::DISABLED) {
            return self::DEACTIVATED;
        }
    }


    public static function getInt($status)
    {
        if ($status == self::ACTIVE) {
            return self::ENABLE;
        } elseif ($status == self::DEACTIVATED) {
            return self::DISABLED;
        }
    }


    public static function revertStatus($int)
    {
        if ($int == self::ENABLE) {
            return self::DISABLED;
        }
        return self::ENABLE;
    }



}