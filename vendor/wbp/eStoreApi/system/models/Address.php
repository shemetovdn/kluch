<?php

namespace wbp\eStoreApi\system\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class Address extends Model
{
    public $id;
    public $country_id;
    public $country;
    public $state_id;
    public $state;
    public $city;
    public $address;
    public $address1;
    public $zip;
    public $type;
    public $typeName;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;

    const SHIPPING_ADDRESS_TYPE = 1;
    const SHIPPING_ADDRESS_TYPE_NAME = 'shipping';
    const BILLING_ADDRESS_TYPE = 0;
    const BILLING_ADDRESS_TYPE_NAME = 'billing';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['id','country_id','first_name', 'last_name', 'email', 'phone', 'state_id','city','address','address1','zip','type','typeName','country','state'], 'safe'],
        ];
    }

    public function getCountry(){
        if($this->country_id){
            $this->country=Countries::getCountryById($this->country_id);
        }
        return $this->country;
    }

    public function getState(){
        if($this->state_id){
            $this->state=Countries::getCountryById($this->country_id)->getRegions()[$this->state_id];
        }
        return $this->state;
    }

    public function __toString(){
        return $this->address.' '.$this->address1.', '.$this->city.', '.$this->getState().', '.$this->getCountry().', '.$this->zip;
    }

}
