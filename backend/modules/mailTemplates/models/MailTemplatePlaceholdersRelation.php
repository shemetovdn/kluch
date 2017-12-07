<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 10.02.2016
 * Time: 15:59
 */
namespace backend\modules\mailTemplates\models;

use backend\models\CheckAccessBehavior;
use backend\modules\stores\models\Stores;
use common\models\WbpActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class MailTemplatePlaceholdersRelation extends WbpActiveRecord{

    public static function tableName()
    {
        return '{{%mail_templates_placeholders}}';
    }


    public function behaviors()
    {
        $behaviours = parent::behaviors();

        return ArrayHelper::merge($behaviours, [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => CheckAccessBehavior::className(),
                'attribute' => 'stores'
            ]
        ]);
    }


}