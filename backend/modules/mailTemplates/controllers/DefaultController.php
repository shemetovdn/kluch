<?php

namespace backend\modules\mailTemplates\controllers;


use backend\controllers\OneModelBaseController;
use backend\modules\mailTemplates\models\MailTemplatePlaceholders;
use backend\modules\mailTemplates\models\MailTemplatePlaceholdersRelation;
use backend\modules\mailTemplates\models\MailTemplates;
use backend\modules\mailTemplates\models\SearchModel;
use yii\helpers\ArrayHelper;

class DefaultController extends OneModelBaseController
{
    public $defaultStoreList;

    public function init(){
        $this->defaultStoreList = [0=>'Please Select'];
        if(\Yii::$app->user->identity->is_super_admin == 1)$this->defaultStoreList = ArrayHelper::merge([-1=>'All Stores'],$this->defaultStoreList);

        $this->ModelName = MailTemplates::className();
        return parent::init();
    }

    public function actionIndex(){
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName, $params);

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }

    public function actionShowPlaceholders(){
        $model = $this->ModelName;
        $id = (int)\Yii::$app->request->post("id");
        if($id > 0) {
            $formModel = $model::findOne(['id' => $id]);
            $allPlaceholders = MailTemplatePlaceholders::getList('id','placeholder','placeholder');
            $placeholders = $formModel->placeholders;
            $avPlaceholders = [];
            foreach ($placeholders as $placeholder) {
                $avPlaceholders[$placeholder->id] = $placeholder->placeholder;
            }

            $notCheckedPlaceholders = array_diff($allPlaceholders,$avPlaceholders);
            return $this->renderAjax('availiable_placeholders_ajax',['formModel'=>$formModel,'placeholders'=>$placeholders,'notCheckedPlaceholders'=>$notCheckedPlaceholders]);
        }
    }

    public function actionAddPlaceholders(){
        if(\Yii::$app->user->identity->is_super_admin  != 1) return false;

        $id = (int)\Yii::$app->request->post("id");
        $pl = "%".\Yii::$app->request->post("params")[0]."%";
        $plD = \Yii::$app->request->post("params")[1];

        $checkExisting = MailTemplatePlaceholders::findOne(['placeholder'=>$pl]);
        if(!$checkExisting) {
            if ($id > 0) {
                $newP = new MailTemplatePlaceholders();
                $newP->placeholder = $pl;
                $newP->description = $plD;
                $newP->save();
            }
            return '<script>placeholdersAction("add","' . $newP->id . '");</script>';
        }else{
            return '<script>placeholdersAction("add","' . $checkExisting->id . '");</script>';
        }
    }

    public function actionAttachPlaceholders()
    {
        if(\Yii::$app->user->identity->is_super_admin  != 1) return false;

        $t_id = (int)\Yii::$app->request->post("id");
        $id = (int)\Yii::$app->request->post("params");
        if($id){
            $newRel = new MailTemplatePlaceholdersRelation();
            $newRel->placeholder_id = $id;
            $newRel->template_id = $t_id;
            $newRel->save();
        }
        return '<script>placeholdersAction("show");</script>';
    }

    public function actionDeattachPlaceholders()
    {
        if(\Yii::$app->user->identity->is_super_admin  != 1) return false;

        $t_id = (int)\Yii::$app->request->post("id");
        $id = (int)\Yii::$app->request->post("params");
        $relation = MailTemplatePlaceholdersRelation::findOne(['template_id'=>$t_id,'placeholder_id'=>$id]);
        if($relation){
            $relation->delete();
        }
        return '<script>placeholdersAction("show");</script>';
    }

}
