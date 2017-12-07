<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
use yii\base\Model;


class Orders extends \backend\modules\contacts\models\OrderPropertyManagment
{

    const FRONTEND_ADD_SCENARIO = 'frontend';

    public $return;

    public function init()
    {
        $this->return=$_SERVER['REQUEST_URI'];
        parent::init();
    }

    public function rules()
    {
        $rules = [
            [['fname', 'email', 'source', 'age', 'return'], 'safe', 'on' => self::FRONTEND_ADD_SCENARIO],
            [['fname', 'email', 'source'], 'required', 'message' => 'Это обязательное поле', 'on' => self::FRONTEND_ADD_SCENARIO],
            ['email', 'email', 'message' => 'Введите валидный email (пример "admin@google.com")', 'on' => self::FRONTEND_ADD_SCENARIO],

            [['fname'], 'string', 'on' => self::FRONTEND_ADD_SCENARIO],
        ];
        return ArrayHelper::merge(parent::rules(), $rules);
    }

    public function attributeLabels()
    {
        return [
            'fname' => 'Имя',
            'email' => 'Email',
            'source' => 'Откуда о нас узнали?',
            'age' => 'Возраст',
        ];
    }

}
