<?php

namespace backend\modules\profile\controllers;

use backend\controllers\BaseController;
use backend\models\UserLog;
use backend\modules\employees\models\EmployeesForm;
use common\models\User;
use Yii;

class DefaultController extends BaseController
{


    public function init(){
        $this->FormModel=EmployeesForm::className();
        $this->ModelName=User::className();

        return parent::init();
    }

    public function actionIndex(){
        $id=Yii::$app->user->id;

        $modelName=$this->ModelName;

        $model=$modelName::findOne(['id'=>(int)$id]);

        $formModelName=$this->FormModel;

        $formModel=new $formModelName(['scenario' => 'edit']);
        $formModel->id=$id;
        $formModel->load($model->getAttributes(),'');
        $formModel->load($model->data->getAttributes(),'');

        if($formModel->load(Yii::$app->request->post())){
            $saved=$formModel->save();
            if($saved){
                $this->addToLog(UserLog::SAVED,$formModel->id);
                Yii::$app->getSession()->setFlash('success', $this->successEditMessage);
            }else{
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            }
        }

        if(Yii::$app->request->isAjax)
            return $this->renderPartial('index');
        else
            return $this->render('index',['formModel'=>$formModel,'model'=>$model]);
    }



}
