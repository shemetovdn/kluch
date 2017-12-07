<?php

namespace backend\modules\agents\controllers;

use backend\controllers\OneModelBaseController;
use backend\models\UserLog;
use backend\modules\agents\models\Agents;
use backend\modules\agents\models\SearchModel;
use Yii;

class DefaultController extends OneModelBaseController
{
    public $UserModelName;

    public function init()
    {
        $this->ModelName = Agents::className();
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
