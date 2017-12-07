<?php

namespace backend\modules\employeesActivity\controllers;

use backend\controllers\BaseController;
use backend\models\UserLog;
use backend\modules\employees\models\Permissions;
use backend\modules\employeesActivity\models\SearchModel;
use common\models\User;
use Yii;

class DefaultController extends BaseController
{
    public function init(){
//        $this->FormModel=EmployeesForm::className();
        $this->ModelName=UserLog::className();

        return parent::init();
    }

    public function actionIndex(){
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName,$params);

        $parentId=User::findOne(Yii::$app->user->id)->parent;
        if(!$parentId) $parentId=Yii::$app->user->id;

        $users=User::find()->where('parent = :parent or id = :parent',['parent'=>$parentId])->all();

        foreach($users as $u)
            $userList[$u->id]=$u->name;

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel,'userList'=>$userList]);
    }

    public function actionEdit($id){
        return $this->actionError();
    }

    public function actionAdd(){
        return $this->actionError();
    }



}
