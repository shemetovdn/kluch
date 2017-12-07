<?php
namespace backend\modules\management\controllers;

use backend\controllers\OneModelBaseController;
use backend\modules\management\models\Management;
use backend\modules\management\models\SearchModel;

class DefaultController extends OneModelBaseController
{

    public function init(){
        $this->ModelName=Management::className();

        return parent::init();
    }

    public function actionIndex(){
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName, $params);
        $columns['sort'] = false;

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }

    public function sortEnable(){
        return false;
    }

}

