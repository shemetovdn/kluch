<?php
namespace backend\modules\objectTypes\controllers;

use backend\controllers\OneModelBaseController;
use backend\modules\objectTypes\models\ObjectTypes;
use backend\modules\objectTypes\models\SearchModel;
use yii;

class DefaultController extends OneModelBaseController
{

    public function init()
    {
        $this->ModelName = ObjectTypes::className();

        return parent::init();
    }

    public function actionIndex()
    {
        $modelName = $this->ModelName;
        $searchModel = new SearchModel();
        $params = \Yii::$app->request->get();
        $dataProvider = $searchModel->search($modelName, $params);

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }


}
