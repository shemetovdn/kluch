<?php

namespace wbp\eStoreApi\system\models;

use yii\helpers\Html;

/**
 * LoginForm is the model behind the login form.
 */
class ShippingAddressForm extends AddressForm
{

    public $sameAsBilling;
    public function rules()
    {
        return [
            [['country_id', 'state_id', 'city', 'address', 'address1', 'zip', 'sameAsBilling', 'existing_address', 'first_name', 'last_name', 'email', 'phone'], 'safe'],
            [['country_id', 'state_id', 'city', 'address', 'zip'], 'required', 'when' => function($model) {
                if($model->existing_address) return false;
                if($model->sameAsBilling == 0) return true;
                return true;
            },'whenClient' => "function (attribute, value) {
                return $('[name=\"".Html::getInputName($this,'sameAsBilling')."\"]').prop('checked') == '0';
                }"
            ],
            [['country_id', 'state_id'], 'integer', 'min'=>1, 'tooSmall'=>'Please select {attribute}', 'when' => function($model) {
                if($model->existing_address) return false;
                if($model->sameAsBilling == 0) return true;
                return true;
            },'whenClient' => "function (attribute, value) {
                return $('[name=\"".Html::getInputName($this,'sameAsBilling')."\"]').prop('checked') == '0';
                }"],
        ];
    }


}
