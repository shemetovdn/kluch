<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 26.10.2015
 * Time: 13:44
 */
namespace backend\modules\pages\models;

use common\models\WbpActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class PagesContent extends WbpActiveRecord
{

    public static function tableName()
    {
        return '{{%pages_content}}';
    }

    public function behaviors()
    {
        $behaviours=parent::behaviors();

        return ArrayHelper::merge($behaviours,[
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ]);
    }

    public function __toString()
    {
        return (string)$this->content;
    }



}