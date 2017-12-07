<?php

namespace common\models;

/**
 * This is the model class for table "{{%user_permissions}}".
 *
 * @property integer $id
 * @property integer $user_id

 */
class UserPermissions extends WbpActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_permissions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','permission_id','store_id'], 'required'],
            [['user_id','permission_id','store_id'], 'integer'],
        ];
    }
}
