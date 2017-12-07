<?php

namespace common\models;

use common\helpers\StringHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_eauth}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $service_name
 * @property string $service_id
 * @property string $data
 * @property string $created_at
 */
class UserEauth extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_eauth}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getUser()
    {
        // Order has_one Customer via Customer.id -> customer_id
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function findByEAuth($service)
    {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        return static::findOne([
            'service_name' => $service->getServiceName(),
            'service_id' => $service->getId(),
        ]);
    }

    public static function addNewEAuth($service, $userId='')
    {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $attributes = $service->getAttributes();
        if(!$userId){
            $user=new User();
            $user->email=$attributes['email'];
            $user->username=StringHelper::prepareUsername($attributes['name']);
            $user->generateAuthKey();
            $user->save();
            $userData = new UserData();
            $userData->user_id=$user->id;
            $userData->first_name=$attributes['first_name'];
            $userData->last_name=$attributes['last_name'];
            $userData->save();
        }
        else $user=User::findIdentity($userId);

        if(!$user->id){
            throw new ErrorException('Error user not found.');
        }


        $eAuth=new self();
        $eAuth->service_name=$service->getServiceName();
        $eAuth->service_id=$service->getId();
        $eAuth->user_id=$user->id;
        $eAuth->data=json_encode($attributes);
        $eAuth->save();


        return $eAuth;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'service_name', 'service_id', 'data'], 'required'],
            [['user_id'], 'integer'],
            [['data'], 'string'],
            [['created_at'], 'safe'],
            [['service_name', 'service_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_name' => 'Service Name',
            'service_id' => 'Service ID',
            'data' => 'Data',
            'created_at' => 'Created At',
        ];
    }
}
