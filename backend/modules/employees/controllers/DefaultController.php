<?php

namespace backend\modules\employees\controllers;

use backend\controllers\BaseController;
use backend\models\Modules;
use backend\models\Permissions;
use backend\models\UserLog;
use backend\modules\employees\models\EmployeesForm;
use backend\modules\employees\models\SearchModel;
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
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName,$params);

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }

    public function actionEdit($id){
        $modelName=$this->ModelName;

        $model=$modelName::findOne(['id'=>(int)$id]);

        $formModelName=$this->FormModel;

        $reflection=new \ReflectionClass($formModelName);
        $formShortName=$reflection->getShortName();

        $formModel=new $formModelName(['scenario' => 'edit']);
        $formModel->id=$id;

        $formModel->load([$formShortName=>$model->getAttributes()]);
        $formModel->load([$formShortName=>$model->data->getAttributes()]);
        $formModel->permissions=$model->permissionsArray;

        if($formModel->load(Yii::$app->request->post())){
            $saved=$formModel->save();
            if($saved){
                $this->addToLog(UserLog::SAVED,$formModel->id);
                Yii::$app->getSession()->setFlash('success', $this->successEditMessage);
            }else{
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            }
        }

        $permissions=Permissions::getList('id','title','id');
        $modules=Modules::find();

        $form=$this->renderPartial($this->formView,['formModel'=>$formModel,'model'=>$model,'permissions'=>$permissions,'modules'=>$modules]);

        return $this->render($this->editView,['model'=>$model,'form'=>$form]);
    }


}
