<?php

namespace wbp\eStoreApi;

use frontend\models\LocalUserDB;
use wbp\eStoreApi\system\models\Address;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract  class User extends Model implements \yii\web\IdentityInterface
{
    const EVENT_AFTER_SAVE = 'save';
    public static $userClass='';

    public $id;
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $auth_key;
    public $password_hash;
    public $password;
    public $addresses;

    public function rules()
    {
        return [
            [[
                'id', 'username', 'email', 'first_name', 'last_name', 'phone', 'password','password_hash','phone'
            ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $data = Yii::$app->eStore->get('users/' . $id,false);
        if($data['id']) {
            $userClass = self::getUserClass();
            $user= new $userClass();
            $user->load($data, '');
            return $user;
        }
        return null;
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
        $data = Yii::$app->eStore->get('users/search?username=' . $username,false);
        if ($data[0]['id']) {
            $userClass = self::getUserClass();
            $user= new $userClass();
            $user->load($data[0], '');
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        $data = Yii::$app->eStore->get('users/search?email=' . $email,false);
        if ($data[0]['id']) {
            $userClass = self::getUserClass();
            $user= new $userClass();
            $user->load($data[0], '');
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        $name = trim($this->first_name . ' ' . $this->last_name);
        if (!$name) $name = $this->username;
        return $name;
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
        $data = Yii::$app->eStore->get('users/check-password?id=' . $this->id . '&password=' . $password,false);
        if($data) {
            if ($data['id']) return true;
        }
        else return false;
//        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $data = Yii::$app->eStore->get('users/set-password?id=' . $this->id . '&password=' . $password,false);
        if($data) {
            return true;
        }
        else return false;
    }


    /**
     * return all adresses array (shipping + billing + all others )
     * @return mixed
     */
//    public function getAddresses(){
//        $data=$data = Yii::$app->eStore->get('users/'.$this->id.'?expand=addresses',false);
//        if($data['addresses']){
//            foreach($data['addresses'] as $addressData){
//                $address=new Address();
//                $address->load($addressData,'');
//                $this->addresses[$address->typeName][]=$address;
//            }
//        }
//        return $this->addresses;
//    }

    public function getClientAddress($type=Address::BILLING_ADDRESS_TYPE){
        $data=$data = Yii::$app->eStore->get('address/get-user-address?clientId='.$this->id.'&type='.$type,false);
        $result=[];
        if($data){
            foreach($data as $addressData){
                $address=new Address();
                $address->load($addressData,'');
                $result[]=$address;
            }
        }
        return $result;
    }

    public function getBillingAddress(){
        $result = $this->getClientAddress(Address::BILLING_ADDRESS_TYPE);
        if($result)return $result[0];
        else return false;
    }

    public function getShippingAddress(){
        $result = $this->getClientAddress(Address::SHIPPING_ADDRESS_TYPE);
        if($result)return $result[0];
        else return false;
    }

    public function setClientAddress($addressArray){
        $addressArray = rawurlencode(json_encode($addressArray));
        $data = Yii::$app->eStore->get('address/set-user-address?clientId='.$this->id."&addressArray=".$addressArray,false);
        return $data;
    }

    public function getClientOrders(){
        $data = Yii::$app->eStore->get('order/get-user-orders?id='.$this->id,false);
        return $data;
    }


    public function getAddressesList(){
        $result=[];
        foreach((array)$this->getAddresses() as $address){
            $result[$address->id] = (string)$address;
        }
        return $result;
    }

    public function save()
    {
        $result;
        if(Yii::$app->user->id == $this->id && $this->id ){
            $result = $this->update();
        }else{
            $result = $this->insert();
       }
        $this->trigger(self::EVENT_AFTER_SAVE);
        return $result;
    }

    public function insert(){
        $data = Yii::$app->eStore->post('users', $this->getAttributes());
        if($data) {
            $this->load($data['data'], '');
            Yii::$app->user->login($this, 3600 * 24 * 30);
            return true;
        }else{
            return false;
        }
    }

    public function update(){
        if(!$this->id){
            return new Exception("No userID");
        }
        $data = Yii::$app->eStore->update('users/'.$this->id, $this->getAttributes());
    }

    public static function findByEAuth($eauth,$user_info)
    {
        $eauthData = [
                'service'=>$eauth->getServiceName(),
                'authorization'=>self::accessProtected($eauth->httpClient,'extraHeaders')
            ];
        $sendArray = ArrayHelper::merge($eauthData,["userData"=>$user_info]);
        $data = Yii::$app->eStore->get('users/eauth-login?eauth='.rawurlencode(json_encode($sendArray)));
        $userClass = self::getUserClass();
        $user= new $userClass();
        $user->load($data, '');
        Yii::$app->user->login($user);
        Yii::$app->user->identity->getEauthGetAdderInfo($eauth->getServiceName(),$user_info);
        return $user;
    }

    //will be realized in local user
    abstract protected function getEauthGetAdderInfo($service,$euthData);

    public static function accessProtected($obj, $prop='') {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    public function getCreditCardType(){
        $data = Yii::$app->eStore->get('credit-card-type');
        $result = [];
        foreach((array) $data as $k=>$v){
            if($v['status'] == 1){
                $result[$v['id']] = $v['title'];
            }
        }
        return $result;
    }

    public function getUserCC()
    {
        $data = Yii::$app->eStore->get('users/get-cc?id='.$this->id,false);
        return $data;
    }

    public function setCC($post_data = []){
        $post_data = ArrayHelper::merge($post_data,['user_id'=>$this->id]);
        $data = Yii::$app->eStore->post('users/set-cc',$post_data,false);
        return $data;
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_SAVE,[$this,'afterSave']);
    }

    public static function getUserClass()
    {
        if(!self::$userClass) self::$userClass = Yii::$app->user->identityClass;
        return self::$userClass;
    }

}
