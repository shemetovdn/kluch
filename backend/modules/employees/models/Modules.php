<?php

namespace backend\modules\employees\models;

use common\models\WbpActiveRecord;

/**
 * This is the model class for table "{{%user_data}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 */
class Modules extends WbpActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%modules}}';
    }

    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['id' => 'permission_id'])
            ->viaTable('{{%modules_permissions}}', ['module_id' => 'id']);
    }

    public function permissionExist($id){
        foreach($this->permissions as $perm){
            if($perm->id==$id) $permission=$perm;
        }
        if(!$permission) return false;
        return $permission;
    }



}
