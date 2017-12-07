<?php
namespace common\models;

use yii\base\Model;


/**
 * Signup form
 */
class UserForm extends Model
{
    public $username;
//    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim', 'on'=>['add','edit']],
            ['username', 'required', 'on'=>['add','edit']],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on'=>['add']],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on'=>['add','edit']],

//            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on'=>'add'],
            ['password', 'string', 'min' => 6, 'on'=>['add','edit']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }

        return null;
    }
}
