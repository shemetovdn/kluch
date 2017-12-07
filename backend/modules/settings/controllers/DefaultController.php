<?php

namespace backend\modules\settings\controllers;

use backend\controllers\BaseController;
use common\models\Config;
use common\models\ConfigForm;
use common\models\ConfigPar;
use Yii;


class DefaultController extends BaseController
{
    public function actionIndex(){

        $formModel=new ConfigForm();
        foreach($formModel->getAttributes() as $name=>$value){
            $formModel->$name=Config::getParameter($name);
        }

        if($formModel->load(Yii::$app->request->post()) && $formModel->validate()){
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            foreach($formModel->getAttributes() as $name=>$value){
                $row=ConfigPar::findOne(['name'=>$name]);
                if(!$row){
                    $row=new ConfigPar();
                    $row->name=$name;
                }

                $row->value=$value;
                $row->save();
            }
            $params = $formModel->getAttributes();
             if(!empty($params["address"])){

                 $xml = simplexml_load_file('http://maps.google.com/maps/api/geocode/xml?address='.$params["address"].'&sensor=false');
                 $status = $xml->status;
                 $latitude = $xml->result->geometry->location->lat;
                 $longitude = $xml->result->geometry->location->lng;

                 $lat=ConfigPar::findOne(['name'=>'lat']);
                 $lng=ConfigPar::findOne(['name'=>'lng']);
                 $lat->value =$latitude;
                 $lng->value =$longitude;

                 $lat->save();
                 $lng->save();
             }
        }

        return $this->render('index',['formModel'=>$formModel]);
    }

}
