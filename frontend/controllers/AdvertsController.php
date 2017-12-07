<?php
namespace frontend\controllers;

use common\models\WbpActiveRecord;
use backend\modules\adverts\models\Adverts;
use backend\modules\industries\models\Industries;
use backend\modules\agentscallback\models\Agentscallback;
use Yii;
use frontend\models\Comments;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class AdvertsController extends BaseController
{
    public function actionView($href)
    {
        $model=Adverts::findOne(['href' => $href]);
        if(!$model){$model=Adverts::findOne(['id' => $href]);}
        if(!$model) throw new NotFoundHttpException('Page not fount.');

        $model->addStatistic();         // Add row in wbp_view

        $query = Adverts::find();
        $where = array(
            'category_id' => $model->category_id,
            'object_type_id' => $model->object_type_id

        );
        $request = Yii::$app->request;
        if($request->post()){
            $price = $request->post('price');
            $size = $request->post('size');
            $id = $request->post('id');
            $city_id = $request->post('city_id');
            $size = $request->post('size');
        }else{
            $where['city_id'] = $model->city_id;
        }

        if(!empty($city_id)){
            $where['city_id'] = $city_id;
        }

        $query = $query->where($where);
        if(!empty($price)){
            $ids = Adverts::getSimularPrice($price, $id);

            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }
        if(!empty($size)){
            $ids = Adverts::getSimularArea($size, $model->object_type_id);
//            var_dump($ids);exit;
            if(!empty($ids)){$query->andWhere(['in', 'id', $ids]);
            }else{$query->andWhere(['in', 'id', -1]);}
        }
        $dataProvider=new ActiveDataProvider(['query'=>$query
            ->andWhere((['!=', 'id', $model->id])),
            'pagination' => false]);


        $contact = new Agentscallback();
        if ($contact->load(Yii::$app->request->post())) {

            if ($contact->save()) {
                \Yii::$app->session->setFlash('success', 'Спасибо, мы свяжемся с Вами в течение 48 часов.');
                return $this->redirect(['adverts/view', 'href'=>$href]);
            } else {
                \Yii::$app->session->setFlash('error',  'Что-то не так, пожалуйста, заполните все поля и отправьте еще раз.');
            }
        }

        return $this->render('view', ['model'=>$model, 'contact'=>$contact, 'dataProvider' => $dataProvider]);
    }

}
