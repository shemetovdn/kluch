<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 18.02.2016
 * Time: 11:57
 */
namespace backend\modules\employees\models;

use common\models\User;
use common\models\UserData;

class Employee extends User{
    public static function getEmployeeList(){
        return self::find()
            ->select(self::tableName().'.*')
            ->leftJoin(UserData::tableName(), UserData::tableName().'.`user_id` = '.self::tableName().'.`id`')
//            ->where(['!=','{{'.self::tableName().'}}.id',Yii::$app->user->id])
            ->where([self::tableName().'.parent'=>User::mainUser()])
            ->with('data');
    }
}