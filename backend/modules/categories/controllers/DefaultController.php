<?php
namespace backend\modules\categories\controllers;

use backend\controllers\OneModelBaseController;
use backend\modules\categories\models\Category;
use backend\modules\categories\models\SearchModel;

class DefaultController extends OneModelBaseController
{

    public function init()
    {
        $this->ModelName = Category::className();

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
