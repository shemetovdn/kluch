<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 01.07.2016
 * Time: 13:08
 */

namespace wbp\helpers;


class Mb_Ucfirst
{
    public static function mb_ucfirst($string, $enc = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
        mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }
}