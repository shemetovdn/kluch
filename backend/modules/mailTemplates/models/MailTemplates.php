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

class MailTemplates extends WbpActiveRecord{

    public static function tableName()
    {
        return '{{%mail_templates}}';
    }

    public function attributeLabels()
    {
        return [
            'store_id'=>'Store'
        ];
    }
    public function rules(){
        return [
            [['store_id','status','title','text','subject','type_id'],'safe','on'=>[self::ADMIN_ADD_SCENARIO,self::ADMIN_EDIT_SCENARIO]],
        ];
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

    public function getStore(){
        return $this->hasOne(Stores::className(),['id'=>'store_id']);
    }

    public function getPlaceholders(){
        return $this->hasMany(MailTemplatePlaceholders::className(), ['id' => 'placeholder_id'])
            ->viaTable(MailTemplatePlaceholdersRelation::tableName(), ['template_id' => 'id']);
    }

    public function getType(){
        return $this->hasOne(MailTemplateTypes::className(),['id'=>'type_id']);
    }
}