<?php

namespace backend\modules\parametrs\controllers;

use backend\controllers\OneModelBaseController;
use backend\models\UserLog;
use backend\modules\parametrs\models\Parametrs;
use backend\modules\parametrs\models\SearchModel;
use backend\modules\parametrs\models\ParametrsValue;
use Yii;

class DefaultController extends OneModelBaseController
{
    public $UserModelName;

    public function init()
    {
        $this->ModelName = Parametrs::className();
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

    public function actionParametrValues()
    {
        $request = Yii::$app->request;
            if($request->post()){
                $id = $request->post('id');
                return $this->getParamsJson($id);
            }

    }

    public function actionDeleteValue()
    {
        $request = Yii::$app->request;
        if($request->post())
        {
            $value_id = $request->post('value_id');
            $param_id = $request->post('param_id');
            $value = ParametrsValue::findOne($value_id);
            if(!empty($value))
            {
                $value->delete();
                return $this->getParamsJson($param_id);
            }

            }


        }
        public function getParamsJson($id){
            $parametr = Parametrs::findOne($id);
//echo "<pre>";var_dump($parametr->parametrValue);exit;
            $paramValues = array();

            foreach($parametr->parametrValue as $key => $value){
                $paramValues[] = array(
                    'id' => $value->id,
                    'value' => $value->value,
                );
            }
            return json_encode($paramValues);
        }


}
