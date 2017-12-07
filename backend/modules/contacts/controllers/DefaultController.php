<?php

namespace backend\modules\contacts\controllers;

use backend\controllers\BaseController;
use backend\models\Status;
use backend\modules\contacts\models\Contacts;
use backend\modules\contacts\models\ContactsAnswers;
use backend\modules\contacts\models\ContactsForm;
use backend\modules\contacts\models\SearchModel;
use Yii;
use yii\data\ActiveDataProvider;


class DefaultController extends BaseController
{

    public function init()
    {
        $this->ModelName = Contacts::className();
        return parent::init();
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Contacts::find()->where('1')->andWhere(['type'=>'0'])
                ->orderBy('id DESC'),
        ]);

        $modelName = $this->ModelName;
        $searchModel = new SearchModel();
        $params = \Yii::$app->request->get();
        //$dataProvider = $searchModel->search($modelName, $params);

        $modelAnswer = new ContactsAnswers();

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
        $model = new ContactsAnswers(); // answer
        $model->load(Yii::$app->request->post());

        $modelForm = Contacts::findOne(Yii::$app->request->post()['Contacts']['id']);
        if (!$modelForm) {
            die('Ah tu hutryn4uk');
        }

        $model->link('contact', $modelForm);

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
        
        $model = Contacts::findOne($id);
        $formModel = new ContactsAnswers();
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
