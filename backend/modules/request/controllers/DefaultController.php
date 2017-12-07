<?php

namespace backend\modules\request\controllers;

use backend\controllers\BaseController;
use backend\models\Status;
use backend\modules\request\models\Request;
use backend\modules\request\models\SearchModel;
use Yii;
use yii\data\ActiveDataProvider;


class DefaultController extends BaseController
{

    public function init()
    {
        $this->ModelName = Request::className();
        return parent::init();
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find()->where(['type'=>2])->orderBy('id DESC'),
        ]);

        $modelName = $this->ModelName;
        $searchModel = new SearchModel();
        $params = \Yii::$app->request->get();
        //$dataProvider = $searchModel->search($modelName, $params);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }


    public function actionView($id)
    {
        $modelName = $this->ModelName;
        $model = $modelName::findOne(['id' => (int)$id]);
        $formModelName = $this->FormModel;
        $formModel = new $formModelName(['scenario' => 'view']);
        $formModel->loadModel($model->id);

        return $this->render('view', ['model' => $model, 'formModel' => $formModel]);
    }

    public function actionPopup($id)
    {
        $this->actionChangeUnreadToRead($id);
        
        $model = Request::findOne($id);
        return $this->renderAjax('_modal', ['model' => $model]);
    }

    public function actionChangeUnreadToRead($id)
    {
        $modelName = $this->ModelName;
        $model = $modelName::findOne(['id' => (int)$id]);
        $model->read = Status::ENABLE;
        if ($model->save()) {
            return 'true';
        }
        return 'false';
    }

}
