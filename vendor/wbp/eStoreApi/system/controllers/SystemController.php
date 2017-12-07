<?php

namespace wbp\eStoreApi\system\controllers;

use app\controllers\BaseController;
use wbp\eStoreApi\system\models\Countries;
use wbp\eStoreApi\system\models\LoginForm;
use wbp\eStoreApi\system\models\RegisterForm;
use Yii;

class SystemController extends BaseController
{
    public $viewsPath='@wbp/eStoreApi/system/views/';

    public function login(){
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $loginForm=$this->renderPartial($this->viewsPath.'loginForm',['model' => $model]);

            return $this->render($this->viewsPath.'login', [
                'model' => $model,
                'loginForm' => $loginForm
            ]);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->login();
    }

    public function register(){
        $model = new RegisterForm();
        $model->scenario='register';

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goBack();
        } else {
            $registerForm=$this->renderPartial($this->viewsPath.'registerForm',['model' => $model]);

            return $this->render($this->viewsPath.'register', [
                'model' => $model,
                'registerForm' => $registerForm
            ]);
        }
    }

    public function actionGetAddress($id){
        $result='';
        $addresses=Yii::$app->user->identity->getAddresses();
        foreach((array)$addresses as $address){
            if($address->id==$id) $result=$address;
        }
        echo json_encode($result);
        Yii::$app->end();
    }

    public function actionGetRegions($id){
        $regions=Countries::getCountryById($id)->regionsList;
        echo json_encode($regions);
        Yii::$app->end();
    }

    public function actionRegister()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->register();
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
