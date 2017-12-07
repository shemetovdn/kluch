<?php

namespace backend\modules\pages\controllers;


use backend\controllers\BaseController;
use backend\modules\pages\models\Pages;
use backend\modules\pages\models\PagesForm;
use backend\modules\pages\models\PagesTopMenuSort;
use backend\modules\pages\models\SearchModel;
use frontend\models\MenuModel;


class DefaultController extends BaseController
{

    public function init(){
        $this->FormModel=PagesForm::className();
        $this->ModelName=Pages::className();

        return parent::init();
    }

    public function actionIndex(){
        $modelName=$this->ModelName;
        $searchModel=new SearchModel();
        $params=\Yii::$app->request->get();
        $dataProvider=$searchModel->search($modelName, $params);

        $widgetName='\wbp\widgets\RelativeListView';
        $valuesSet=false;
        if(isset($params['SearchModel'])){
            foreach($params['SearchModel'] as $name=>$value){
                if($name=='order') continue;
                if($value) $valuesSet=true;
            }
        }
        if($valuesSet) $widgetName='\yii\widgets\ListView';

        return $this->render('index',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel,'widgetName'=>$widgetName]);
    }

    public function actionGetContent(){
        $formModel=new $this->FormModel();
        echo $this->renderAjax('contentEditor',['formModel'=>$formModel]);
        \Yii::$app->end();
    }

    public function actionGetSorter(){
        $id = (int)\Yii::$app->request->post()['id'];
        if($id > 0){
            $topMenuList = MenuModel::getTopMenu('',$id);
            echo $this->renderAjax('menu_sort_item',['topMenuList'=>$topMenuList]);
        }
        \Yii::$app->end();
    }

    public function actionSetSorter(){
        $new_sort_array = \Yii::$app->request->post()['new_sort_list'];
        $language_id = (int)\Yii::$app->request->post()['language_id'];
        if(count($new_sort_array)>0){
            //remove all existing
            PagesTopMenuSort::deleteAll(['language_id'=>$language_id]);
            foreach ($new_sort_array as $new_sort_val=>$page_id) {
                $sortModel = new PagesTopMenuSort();
                $sortModel->page_id = $page_id;
                $sortModel->language_id = $language_id;
                $sortModel->sort = $new_sort_val;
                $sortModel->save();
            }
        }
        \Yii::$app->end();
    }

}
