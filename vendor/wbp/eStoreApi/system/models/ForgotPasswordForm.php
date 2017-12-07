<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 15.02.2016
 * Time: 17:04
 */
namespace wbp\eStoreApi\system\models;

use wbp\eStoreApi\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ForgotPasswordForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'validateExistingOfEmail'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email','safe']
        ];
    }

    public function validateExistingOfEmail()
    {
        if(!User::findByEmail($this->email)) {
            $this->addError("email", "Sorry! We can not find such email address in our databases");
        }
    }

    public function forgotPassword(){
        if ($this->validate()) {
            $data = Yii::$app->eStore->get('users/reset-password?email='.rawurlencode($this->email),false);
            if($data){
                Yii::$app->getSession()->setFlash('success', 'Reset password instructions was sent to your email');
            }else{
                Yii::$app->getSession()->setFlash('success', 'We have some problems with reseting your password');
            }
            return $data;
        } else {
            return false;
        }
        return false;
    }


}