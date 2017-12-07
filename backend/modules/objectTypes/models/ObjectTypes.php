<?php

namespace backend\modules\objectTypes\models;

use common\models\WbpActiveRecord;
use backend\modules\parametrs\models\Parametrs;
use yii\helpers\Url;


class ObjectTypes extends WbpActiveRecord
{
    protected $arrayPars=['category_ids', 'params_ids'];
    public static $imageTypes = ['ObjectType'];
    public static function tableName()
    {
        return '{{%object_types}}';

    }

    public function rules()
    {
        return [
            [['title','status', 'category_ids', 'params_ids'], 'safe'],
            [['title'], 'required', 'on' => [self::ADMIN_ADD_SCENARIO]],
            [['title'], 'required', 'on' => [self::ADMIN_EDIT_SCENARIO,self::ADMIN_ADD_SCENARIO]],
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => \Yii::t('admin', 'Заголовок'),
            'category_ids' => \Yii::t('admin', 'Типы объявлений'),
            'params_ids' => \Yii::t('admin', 'Параметры'),
        ];
    }

    public function getParametrs()
    {
        $params = Parametrs::find()->where(['id' => $this->params_ids, 'status' => 1])->all();

        return $params;
    }
    public static function getMenuItemsByCategory($id){
        $typesArray =[];
        $items = [];
        $category = \backend\modules\categories\models\Category::findOne($id);
        if($category){$category_href = $category->href;}
        $types = ObjectTypes::find()->where(['like','category_ids',''.$id.''])->andWhere(['status' => 1])->asArray()->all();
$count = 0;
        $totalCount = 0;
        foreach ($types as $key =>$value){

            $items[]= array('label'=>$value['title'],'url'=>['catalog/'.$category_href.'/'.$value['href']]);
            if($totalCount == 7){
                $items[]= array('label'=>'Эксклюзивная продажа','url'=>['catalog/'.$category_href.'/exclusive']);
            }


            }

        return $items;
    }
    public static function getMenuItemsTenancyCategory(){
        $typesArray =[];
        $items = [];
        $types = ObjectTypes::find()->where(['like','category_ids','2'])->orWhere(['like','category_ids','3'])->asArray()->all();
        $count = 0;
        foreach ($types as $key =>$value){

            $items[]= array('label'=>$value['title'],'url'=>['catalog/arenda/'.$value['href']]);
            if($count == 4){
                $typesArray[] = array(
                    'label'=>'',
                    'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
                    'items'=> $items
                );
                $items = [];
                $count = 0;
            }
            $count++;
        }
//echo "<pre>";var_dump($typesArray);exit;
        return $typesArray;
    }

    public static function getMenuItemsBuyCategory(){
        $typesArray =[];
        $items = [];
        $category = \backend\modules\categories\models\Category::findOne(1);
        if($category){$category_href = $category->href;}
        $types = ObjectTypes::find()->where(['status' => 1])->andWhere(['like','category_ids','1'])->asArray()->all();
        $count = 0;
        $totalCount = 0;
        foreach ($types as $key =>$value){

            $items[]= array('label'=>$value['title'],'url'=>['catalog/'.$category_href.'/'.$value['href']]);
            if($totalCount == 6){
                $items[]= array('label'=>'Эксклюзивная продажа','url'=>['catalog/'.$category_href.'/exclusive']);
            }
            if($count == 3){
                $typesArray[] = array(
                    'label'=>'',
                    'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
                    'items'=> $items
                );
                $items = [];
                $count = 0;
            }
            $count++;
            $totalCount++;
        }
        return $typesArray;
    }

    public static function getMenuItemsBuyLease(){
        $typesArray =[];
        $items = [];
        $categories = \backend\modules\categories\models\Category::find()->where(['id'  => [2,3]])->all();
        $count = 0;
        $totalCount = 0;
        foreach($categories as $category){
        if($category){$category_href = $category->href;}
            $types = ObjectTypes::find()->where(['status' => 1])->andWhere(['like','category_ids',$category->id])->asArray()->all();

            foreach ($types as $key =>$value){
$subtitle = 'Аренда';
                if($value['id'] == 1 || $value['id'] == 16){
                    $subtitle = $category->title;
                }

                $items[]= array('label'=>$subtitle. ' ' .$value['title'],'url'=>['catalog/'.$category_href.'/'.$value['href']]);
//                if($totalCount == 6){
//                    $items[]= array('label'=>'Эксклюзивная продажа','url'=>['catalog/'.$category_href.'/exclusive']);
//                }
                if($count == 3){
//                    var_dump($items);exit;
                    $typesArray[] = array(
                        'label'=>'',
                        'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
                        'items'=> $items
                    );
                    $items = [];
                    $count = 0;
                }
                $count++;
                $totalCount++;
            }
        }
        $typesArray[] = array(
            'label'=>'',
            'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
            'items'=> $items
        );

//        echo "<pre>";var_dump($categories);exit;
        return $typesArray;
    }


    public static function getMenuItemsBuyLeaseMobail(){
        $typesArray =[];
        $items = [];
        $categories = \backend\modules\categories\models\Category::find()->where(['id'  => [2,3]])->all();
        $count = 0;
        $totalCount = 0;
        foreach($categories as $category){
            if($category){$category_href = $category->href;}
            $types = ObjectTypes::find()->where(['status' => 1])->andWhere(['like','category_ids',$category->id])->asArray()->all();

            foreach ($types as $key =>$value){
                $subtitle = 'Аренда';
                if($value['id'] == 1 || $value['id'] == 16){
                    $subtitle = $category->title;
                }

                $items[]= array('label'=>$subtitle. ' ' .$value['title'],'url'=>['catalog/'.$category_href.'/'.$value['href']]);

                $count++;
                $totalCount++;
            }

        }


//        var_dump($typesArray);exit;
        return $items;
    }


    public static function getMenuItemsBuyCategoryMobail(){
        $typesArray =[];
        $items = [];
        $category = \backend\modules\categories\models\Category::findOne(1);
        if($category){$category_href = $category->href;}
        $types = ObjectTypes::find()->where(['status' => 1])->andWhere(['like','category_ids','1'])->asArray()->all();
        $count = 0;
        $totalCount = 0;
        foreach ($types as $key =>$value){

            $items[]= array('label'=>$value['title'],'url'=>['catalog/'.$category_href.'/'.$value['href']]);
            if($totalCount == 7){
                $items[]= array('label'=>'Эксклюзивная продажа','url'=>['catalog/'.$category_href.'/exclusive']);
            }
            $count++;
            $totalCount++;
        }
//        echo "<pre>"; var_dump($items);exit;
        return $items;
    }

}