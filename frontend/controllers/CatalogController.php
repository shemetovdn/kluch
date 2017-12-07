<?php
namespace frontend\controllers;

use backend\modules\seo\models\SEO;
use backend\modules\adverts\models\Adverts;
use backend\modules\pages\models\Pages;
use backend\modules\categories\models\Category;
use backend\modules\objectTypes\models\ObjectTypes;
use Yii;
use yii\helpers\Url;
use frontend\models\Comments;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\Response;



class CatalogController extends BaseController
{
    public function actionIndex($category='',$object='')
    {
        $url = array(
            'category' => $category,
            'object' => $object,
        );
        $where = array(
            'status'=>1
        );
        $arenda = "";
        $objectCategory = Category::findOne(['href'=>$category]);
        $objectType = ObjectTypes::findOne(['href'=>$object]);

        if($objectCategory){
            $where['category_id'] = $objectCategory->id;
        }else{
            if($category != ''){$where['category_id'] = '';}
            if($category == 'arenda'){$where['category_id'] = [2,3];$arenda = "arenda";}

        }
        if($objectType){
            $where['object_type_id'] = $objectType->id;
        }else{
            if($object  == 'exclusive'){$where['exclusive'] = 1;
            }else{
                if($object  != ''){$where['object_type_id'] = '';
                }
            }

        }
        $query=Adverts::find();
        $request = Yii::$app->request;
        $filter_params = $request->post();
        if($request->isAjax || $request->post()){
            $city_id = $request->post('city');
            $price_from = $request->post('price-from');
            $price_to = $request->post('price-to');
            $area_from = $request->post('area-from');
            $area_to = $request->post('area-to');
            if($request->post('total_arrea_from')){$area_from = $request->post('total_arrea_from');}
            if($request->post('total_arrea_to')){$area_to = $request->post('total_arrea_to');}
            $homestead_from = $request->post('homestead_from');
            $homestead_to = $request->post('homestead_to');
            $floor_from = $request->post('floor_from');
            $floor_to = $request->post('floor_to');
            $nearness_id = $request->post('nearness');
            $target = $request->post('target');
            $repairs_id = $request->post('repairs');
            $furniture_id = $request->post('furniture');
            $rooms = $request->post('rooms');
            $cars = $request->post('cars');
            $comfort = $request->post('comfort');
            $heating = $request->post('heating');
            $water = $request->post('water');
            $electricity = $request->post('electricity');
            $parking = $request->post('parking');
            $garage_type = $request->post('garage_type');
            if($objectType && ($objectType->id == 4 || $objectType->id == 5)){
                $homestead_from = $area_from;
                $homestead_to = $area_to;
                $area_from = "";
                $area_to = "";
            }

            if($city_id){
                $where['city_id'] = $city_id;
            }

        }
        $model=Pages::findByHref('сatalog')->one();
//        SEO::setByModel($model);
//        if(!$model) throw new NotFoundHttpException('Page not fount.');

        $query=$query->where($where);
        if(!empty($rooms)){

            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByIds($rooms, 2);
            if(!empty($ids)){
                $query->andWhere(['in', 'id', $ids]);
            }else{
                $query->andWhere(['in', 'id', -1]);
            }
        }
        if(!empty($cars)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByIds($cars, 19);

            if(!empty($ids)){
                $query->andWhere(['in', 'id', $ids]);
            }else{
                $query->andWhere(['in', 'id', -1]);
            }
        }
        if(!empty($comfort)){

            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByIds($comfort, 8);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }
        if(!empty($nearness_id)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($nearness_id, 5);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($target)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($target, 26);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($furniture_id)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($furniture_id, 7);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($heating)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($heating, 20);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($water)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($water, 22);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($electricity)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($electricity, 23);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($parking)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($parking, 25);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($garage_type)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($garage_type, 24);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($repairs_id)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsById($repairs_id, 6);
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }

        if(!empty($price_from)){$query->andWhere(['>=', 'price', $price_from]);}

        if(!empty($price_to)){$query->andWhere(['<=', 'price', $price_to]);}

        if(!empty($area_from) || !empty($area_to)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByArea($area_from, $area_to);

            if(!empty($ids)){
//                    $ids = implode(',', $ids);
                $query->andWhere(['in', 'id', $ids]);
            }else{
                $query->andWhere(['in', 'id', -1]);
            }
        }
        if(!empty($homestead_from) || !empty($homestead_to)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByText(21, $homestead_from, $homestead_to);

            if(!empty($ids)){
//                    $ids = implode(',', $ids);
                $query->andWhere(['in', 'id', $ids]);
            }else{
                $query->andWhere(['in', 'id', -1]);
            }
        }


        if(!empty($floor_from) || !empty($floor_to)){
            $ids = \backend\modules\adverts\models\AdvertsParametrs::getAdvertsByFloor($floor_from, $floor_to);

            if(!empty($ids)){
                $query->andWhere(['in', 'id', $ids]);
            }else{
                $query->andWhere(['in', 'id', -1]);
            }
        }
        $query=$query->orderBy(' date desc');
        $dataProvider=new ActiveDataProvider(['query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],]);

        // for googleMap
        $totaladverts = $query->all();
        $totaladverts_array = array();
        foreach($totaladverts as $key => $value){
            $images = array();
            foreach ($value->images as $img_index=>$img){
                $images[] = $img->getUrl(320, 320);
            }
            $totaladverts_array[] = array(
                'id'=>$value->id,
                'href'=>$value->getUrl(),
                'title'=>$value->title,
                'price'=>$value->price,
                'address'=>$value->address,
                'lat'=>$value->lat,
                'lng'=>$value->lng,
                'images'=>$images,
            );
        }
        // for googleMap END

        return $this->render('index', ['model'=>$model,
            'dataProvider'=>$dataProvider,
            'url' => $url,
            'category' => $objectCategory,
            'object' => $objectType,
            'totaladverts'=> $totaladverts_array,
            "exclusive" => $object,
            "arenda" => $arenda,
            "filter_params" => $filter_params
        ]);
    }
    public function actionGetObjectTypes(){
        $request = \Yii::$app->request;
        if($request->isAjax){
            $id = $request->post('id');
            $types_response = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['status' =>1])->andWhere(['like','category_ids',''.$id.''])->all();
            $types = array();
            foreach ($types_response as $key =>$value){
                $types []= array(
                    "id" => $value->id,
                    "href" => $value->href,
                    "title" => $value->title,
                    "image" => $value->image->getUrl(),
                );
            }

            echo json_encode($types);
        }
    }

}
