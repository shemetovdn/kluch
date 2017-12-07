<?php
namespace common\models;

use backend\models\Modules;
use backend\models\Permissions;
use backend\modules\stores\models\Stores;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends WbpActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_DISABLED = 11;
    const ROLE_USER = 10;

    public static $imageTypes=['User'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function getEauth()
    {
        return $this->hasMany(UserEauth::className(), ['user_id' => 'id']);
    }
    public function getData()
    {
        $relation=$this->hasOne(UserData::className(), ['user_id' => 'id']);
        if(!$relation->one()->id){
            $userData=new UserData();
            $userData->user_id=$this->id;
            $userData->save();
        }
        return $relation;
    }

    public function getParentUser()
    {
        return $this->hasOne(User::className(), ['id' => 'parent']);
    }

    public function getPermissions()
    {
        return $this->hasOne(UserPermissions::className(), ['user_id' => 'id']);
    }

    public function getPermissionsArray(){
        $permissions=$this->getPermissions();
        foreach($permissions->all() as $permission){
            $result[$permission->store_id][$permission->module_id][$permission->permission_id]=true;
        }

        return $result;
    }

    public function checkPermission($module,$action_id,$store_id=''){
        if($this->is_super_admin) return true;
//        if($this->parent==0){
//            return array_keys(Stores::getList('id','title','id'));
//        }
//
        $module=Modules::findOne(['name'=>$module]);
        $module_id=$module->id;
        $permissionArray=$this->getPermissionsArray();
        $permission=Permissions::find()->where(['like','action',','.$action_id.','])->one();

        if($store_id && $permissionArray[$store_id][$module_id][$permission->id]) return true;
        elseif($store_id) return false;


        $tmpArray=[];
        foreach((array)$permissionArray as $store_id=>$array){
            if($array[$module_id][$permission->id]) $tmpArray[]=$store_id;
        }
        if(!count($tmpArray)) return false;
        else return $tmpArray;
    }

    public function getName(){
        $name = trim($this->data->first_name.' '.$this->data->last_name);
        if(!$name) $name=$this->username;
        if(!$name) $name=$this->email;
        if(!$name) $name="UserId: ".$this->id;
        return $name;

    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviours=parent::behaviors();

        return ArrayHelper::merge($behaviours,[
            TimestampBehavior::className(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_DISABLED]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        if(!empty($password)){
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }

    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function mainUser(){
        $currentUser=User::findOne(['id'=>Yii::$app->user->id]);
        if($currentUser->parent){
            $parent=$currentUser->parent;
        }else{
            $parent=Yii::$app->user->id;
        }

        return $parent;
    }
}
