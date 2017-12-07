<?php

namespace backend\modules\orderPropertyManagment\controllers;

use backend\controllers\BaseController;
use backend\models\Status;
use backend\modules\orderPropertyManagment\models\OrderPropertyManagment;
use backend\modules\orderPropertyManagment\models\OrderPropertyManagmentAnswers;
use backend\modules\orderPropertyManagment\models\OrderPropertyManagmentForm;
use backend\modules\orderPropertyManagment\models\SearchModel;
use Yii;
use yii\data\ActiveDataProvider;


class DefaultController extends BaseController
{

    public function init()
    {
        $this->ModelName = OrderPropertyManagment::className();
        return parent::init();
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderPropertyManagment::find()->where('1')->andWhere(['type'=>'1'])
                ->orderBy('id DESC'),
        ]);

        $modelName = $this->ModelName;
        $searchModel = new SearchModel();
        $params = \Yii::$app->request->get();
        //$dataProvider = $searchModel->search($modelName, $params);

        $modelAnswer = new OrderPropertyManagmentAnswers();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'modelAnswer' => $modelAnswer
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

    public function actionCreateAnswer()
    {
        $model = new OrderPropertyManagmentAnswers(); // answer
        $model->load(Yii::$app->request->post());

        $modelForm = OrderPropertyManagment::findOne(Yii::$app->request->post()['OrderPropertyManagment']['id']);
        if (!$modelForm) {
            die('Ah tu hutryn4uk');
        }

        $model->link('orderPropertyManagment', $modelForm);

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Reply was successfully send');
        } else {
            Yii::$app->session->setFlash('error', 'Something wrong!');
        }
        return $this->redirect('index');
    }

    public function actionPopup($id)
    {
        $this->actionChangeUnreadToRead($id);
        
        $model = OrderPropertyManagment::findOne($id);
        $formModel = new OrderPropertyManagmentAnswers();
        return $this->renderAjax('_modal', ['formModel' => $formModel, 'model' => $model]);
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
