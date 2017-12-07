<?php

namespace backend\modules\moduleCreator\controllers;


use backend\controllers\BaseController;
use backend\models\FileTreeModel;
use backend\models\Menu;
use backend\models\Modules;
use backend\modules\moduleCreator\models\ModulesForm;
use backend\modules\moduleCreator\models\SearchModel;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;


class DefaultController extends BaseController
{

    public function behaviors(){
        if(\Yii::$app->user->identity->is_super_admin != 1  ) {
            return ArrayHelper::merge(parent::behaviors(), [
                'authenticator' => [
                    'class' => HttpBasicAuth::className(),
                    'auth' => [$this, 'auth'],
                    'realm' => 'Please authorize/reauthorize as super user!'
                ]
            ]);
        }else{
            return parent::behaviors();
        }
    }

    public function auth($username, $password){
        $res=null;
        $user=User::findByUsername($username);
        if($user->id> 0 && $user->is_super_admin == 1 && $password !== NULL) {
            if ($user->validatePassword($password)) {
                $res = $user;
            }
        }
        return $res;
    }

    public function init(){
        $this->FormModel=ModulesForm::className();
        $this->ModelName=Modules::className();
        return parent::init();
    }

    public function actionIndex(){
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName,$params);
        $menuList = Menu::getMenuItems();

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel,'menuList'=>$menuList]);
    }

    public function actionGetTree(){
        $id  = (int)\Yii::$app->request->post('id');
        $tree = [];
        if($id > 0){
            $newM = $this->ModelName;
            $classPlace = $newM::findOne(['id'=>$id])->nameClass;
            if($classPlace) {
                $path = \Yii::getAlias('@serverDocumentRoot').DIRECTORY_SEPARATOR.str_replace("\\", "/", $classPlace);
                $tree = FileTreeModel::getSubFolders($path);
            }else{
                $tree['error'] = 'Module "ClassName" is empty';
            }
        }else{
            $tree['error'] = 'Wrong module ID ';
        }

        echo $this->renderPartial('tree',['tree'=>$tree]);
        \Yii::$app->end();
    }

    public function actionNewSort(){
        print_r(\Yii::$app->request->post('new_sort'));
        //echo $this->renderPartial('nSort');
        \Yii::$app->end();
    }


}
