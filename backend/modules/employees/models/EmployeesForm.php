<?php
namespace backend\modules\employees\models;

use backend\models\BaseFormModel;
use common\models\User;
use common\models\UserPermissions;
use Yii;

/**
 * Login form
 */
class EmployeesForm extends BaseFormModel
{
    public $modelName = '\common\models\User';

    public $id, $username,
        $email,
        $password,
        $first_name,
        $last_name,
        $phone, $permissions;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'first_name', 'last_name', 'phone', 'permissions'], 'safe'],
            [['username', 'password'], 'required', 'on' => 'add'],
            ['username', 'required', 'on' => 'edit'],
            ['username', function ($attribute, $params) {
                if (!ctype_alnum($this->$attribute)) {
                    $this->addError($attribute, 'The store name must contain letters or digits.');
                }
            }],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This store name has already been taken.', 'on' => 'add'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => Yii::t('admin', 'Name'),
            'title' => Yii::t('admin', 'Title'),
            'token' => Yii::t('admin', 'Auth Key'),
        ];
    }


    public function afterSave()
    {
        $model = $this->findModel();

        $attributes = $this->getAttributes();
        if ($attributes['password']) {
            $model->setPassword($attributes['password']);
            $model->generateAuthKey();
        }

        if (!$model->parent) $model->parent = User::mainUser();

        $model->save();

        if ($this->permissions)
            foreach ($this->permissions as $store_id => $array) {
                foreach ($array as $module_id => $array1) {
                    foreach ($array1 as $permission_id => $value) {
                        $permission = UserPermissions::findOne([
                            'user_id' => $model->id,
                            'store_id' => $store_id,
                            'module_id' => $module_id,
                            'permission_id' => $permission_id
                        ]);
                        if (!$value && $permission->id) {
                            $permission->delete();
                        } elseif ($value && !$permission->id) {
                            $permission = new UserPermissions();
                            $permission->user_id = $model->id;
                            $permission->store_id = $store_id;
                            $permission->module_id = $module_id;
                            $permission->permission_id = $permission_id;

                            $permission->save();
                        }

                    }
                }
            }


        unset($attributes['id']);
        $model->data->setAttributes($attributes, false);
        $model->data->save();
    }

}
