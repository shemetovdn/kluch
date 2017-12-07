<?php

namespace wbp\eStoreApi\system\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class AddressForm extends Model
{
    public $country_id;
    public $state_id;
    public $city;
    public $address;
    public $address1;
    public $zip;
    public $existing_address;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['country_id', 'state_id','city','address','address1','zip', 'existing_address','first_name', 'last_name', 'email', 'phone'], 'safe'],
            [['country_id', 'state_id','city','address','address1','zip'], 'required'],
            [['country_id', 'state_id'], 'integer', 'min'=>1, 'tooSmall'=>'Please select {attribute}'],
        ];
    }

    public function getAddress(){
        $address=new Address();
        $address->load($this->getAttributes(),'');
        if($this->existing_address) $address->id=$this->existing_address;
        return $address;
    }

    public function beforeValidate()
    {
        if($this->existing_address){
            $addresses=Yii::$app->user->identity->getClientAddress();
            if($addresses){
                foreach ($addresses as $address){
                    if($address->id==$this->existing_address){
                        $this->load($address->getAttributes(),'');
                    }
                }
            }else{
                $this->existing_address='';
            }
        }
        return parent::beforeValidate();
    }

    public function attributeLabels(){
        return [
            'country_id'=>'Country',
            'state_id'=>'State',
            'existing_address'=>'Select from existing'
        ];
    }

}
