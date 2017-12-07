<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 04.11.2015
 * Time: 12:43
 */
namespace wbp\ClassNameGetter;

class ClassNameGetter{
    public static function getClassname($obj, $without_type = true,$toLower = true)
    {
        $classname = get_class($obj);
        if ($without_type) {
            if (preg_match('@\\\\([\w]+)(Controller|Action)$@', $classname, $matches)) {
                $classname = $matches[1];
            }
        } else {
            if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
                $classname = $matches[1];
            }
        }
        if($toLower === true ) $classname = mb_strtolower($classname);

        return $classname;
    }
}