<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 05.08.2015
 * Time: 16:59
 */

namespace backend\models;

class StatusQuery extends \yii\db\ActiveQuery
{
    public function init()
    {
        $modelClass = $this->modelClass;
        $tableName = $modelClass::tableName();
        $this->andWhere([$tableName.'.status' => 1]);
        parent::init();
    }

}