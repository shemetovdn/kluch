<?php

namespace backend\modules\agentscallback\controllers;

use backend\controllers\BaseController;
use backend\models\Status;
use backend\modules\agentscallback\models\Agentscallback;
use backend\modules\agentscallback\models\SearchModel;

use backend\modules\agents\models\Agents;

use yii\data\ActiveDataProvider;


class DefaultController extends BaseController
{

    public function init()
    {
        $this->ModelName = Agentscallback::className();
        return parent::init();
    }

    public function actionIndex()
    {

        $userId = \Yii::$app->user->identity->id;
        $query = Agentscallback::find()->where('1')->andWhere(['agent_id'=>$userId])->orderBy('id DESC');

        if(Agents::getById($userId)->role == 10){
            $query = Agentscallback::find()->orderBy('id DESC');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $searchModel = new SearchModel();

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
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
        
        $model = Agentscallback::findOne($id);
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
