<?php

namespace wbp\eStoreApi\system\models;

/**
 * LoginForm is the model behind the login form.
 */
class BillingAddressForm extends AddressForm
{
    public function rules()
    {
        return [
            [['country_id', 'state_id', 'city', 'address', 'address1', 'zip'], 'safe'],
            [['country_id', 'state_id', 'city', 'address', 'zip'], 'required'],
//            [['country_id', 'state_id'], 'compare', 'compareValue' => 100, 'operator' => '>='],
            [['country_id', 'state_id'], 'integer', 'min'=>1, 'tooSmall'=>'Please select {attribute}'],
        ];
    }

}
