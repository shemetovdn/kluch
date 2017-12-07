<?php
namespace backend\modules\seo\controllers;

use backend\controllers\OneModelBaseController;
use backend\modules\lifestyle\models\LifestyleCooking;
use backend\modules\lifestyle\models\LifestyleHealth;
use backend\modules\news\models\News;
use backend\modules\pages\models\Pages;
use backend\modules\seo\models\SEO;
use backend\modules\workout\models\WorkoutPlans;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

class DefaultController extends OneModelBaseController
{
    public $items;
    public $editedTitle;

    public function init(){
        $this->ModelName=SEO::className();

        $this->items=[
            [
                'key'=>'default',
                'title'=>'Мета по умолчанию'
            ],
            [
//                'key'=>'news',
                'title'=>'Статьи',
                'itemsClassName'=>News::className()
            ],
            [
                'title'=>'Статические страници',
                'itemsClassName'=>Pages::className()
            ],
        ];



        return parent::init();
    }

    public function prepareItems($items,$subkey=''){
        $result=[];
        foreach ($items as $item) {
            $subkeyThis=$subkey;
            $listItem=[];
            $listItem['label']=$item['title'];
            if(isset($item['key'])){
                if(!isset($item['editable'])){
                    $seoItem=SEO::findByKey(trim($subkeyThis.'-'.$item['key'],'-'));
                    $listItem['url']=Url::to(['edit','id'=>$seoItem->id]);
                    $listItem['id']=$seoItem->id;
                }
                if($subkeyThis) $subkeyThis.='-';
                $subkeyThis.=$item['key'];
            }

            if(isset($item['id'])){
                $seoItem=SEO::findByKey(trim($subkeyThis.'-'.$item['id'],'-'));
                $listItem['id']=$seoItem->id;
                $listItem['url']=Url::to(['edit','id'=>$seoItem->id]);
            }

            if(isset($item['items'])) $listItem['items']=$this->prepareItems($item['items'],$subkeyThis);
            if(isset($item['itemsClassName'])) {
                $className=$item['itemsClassName'];
                $seoKey=$className::$seoKey;
                if($seoKey) $subkeyThis=$seoKey;
                $models=$className::find()->orderBy('sort')->asArray()->all();
                $listItem['items']=$this->prepareItems($models,$subkeyThis);
            }

            $result[]=$listItem;
        }
        return $result;
    }

    public function findItem($items,$id){
        foreach($items as $item){
            if($item['id']==$id) return $item;
            if(isset($item['items'])){
                $result=$this->findItem($item['items'],$id);
                if($result) return $result;
            }
        }
        return false;
    }

    public function actionEdit($id)
    {
        $items=$this->prepareItems($this->items);

        $this->editedTitle=$this->findItem($items,$id);
        return parent::actionEdit($id);
    }


    public function actionIndex(){
        $items=$this->prepareItems($this->items);

        $dataProvider=new ArrayDataProvider([
            'allModels'=>$items,
            'sort' => [
                'attributes' => ['sort'],
            ]
        ]);

        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
