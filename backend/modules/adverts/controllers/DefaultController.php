<?php
namespace backend\modules\adverts\controllers;

use backend\controllers\OneModelBaseController;
use backend\modules\adverts\models\Adverts;
use backend\modules\adverts\models\Apartment;
use backend\modules\adverts\models\Router;
use backend\modules\adverts\models\SearchModel;
use yii;
use backend\models\UserLog;
use backend\modules\agents\models\Agents;

class DefaultController extends OneModelBaseController
{

    public function init()
    {
        $this->ModelName = Adverts::className();

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

    public function actionGetCordinates(){
        $request = \Yii::$app->request;
        if($request->isAjax){
            if(trim($request->post('address')) == "Прага"){
                $region = " ";
            }else{$region = "Крым ";}
            $address = $region.$request->post('address');
            $xml = simplexml_load_file('http://maps.google.com/maps/api/geocode/xml?address='.$address.'&sensor=false');
            $status = $xml->status;
            $lat = $xml->result->geometry->location->lat;
            $lng = $xml->result->geometry->location->lng;
            if($status == 'OK'){
                echo $lat.' | '.$lng;
            }
        }

}

    public function actionSelectCategory()
    {
        $formModel = new Router();

        return $this->render('select_category',['formModel' => $formModel]);
    }


    public function actionRouteByType()
    {
        $file_name = 'edit';
        $form = Yii::$app->request->post("Router");
        $model = new Router();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
//                Yii::$app->session->setFlash('success', 'Thanks for contacting us!<br>We try to respond as soon as possible, so we will<br>get back to you shortly. In the meantime keep<br>learning about our products.');
                $form = Yii::$app->request->post("Router");
                $category_id = $form["category_id"];
                $object_type_id = $form["object_type_id"];

                $this->redirect(['add','category_id'=>$category_id,'object_type_id'=>$object_type_id]);
                Yii::$app->end();
            } else {
//                echo "<pre>";var_dump($contact);exit;
                Yii::$app->session->setFlash('Error', 'Something wrong, please try again!');
            }

        }
        return $this->render('select_category',['formModel' => $model]);
    }

    public function actionGetObjectTypes(){
        $request = \Yii::$app->request;
        if($request->isAjax){
            $id = $request->post('id');
            $types = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['like','category_ids',''.$id.''])->asArray()->all();
            echo json_encode($types);
        }
    }

}
