<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 25.02.2016
 * Time: 10:58
 */

namespace frontend\controllers;

use backend\modules\pages\models\Pages;
use backend\modules\services\models\Services;
use backend\modules\seo\models\SEO;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ServicesController extends BaseController
{

    public function actionIndex()
    {
        $dataProvider=new ActiveDataProvider([
            'query'=>Services::find()->where(['status'=>1])
        ]);
        $model=Pages::findByHref('news')->one();
        return $this->render('index', ['dataProvider' => $dataProvider,'model'=>$model]);
    }

    public function actionView($href)
    {
        $services=Services::findByHref($href)->one();
        return $this->render('view', ['services' => $services]);
    }

}
