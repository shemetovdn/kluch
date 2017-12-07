<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 25.02.2016
 * Time: 10:58
 */

namespace frontend\controllers;

use backend\modules\news\models\News;
use backend\modules\pages\models\Pages;
use backend\modules\seo\models\SEO;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class NewsController extends BaseController
{

    public function actionIndex()
    {
        $model=Pages::findByHref('news')->one();
        SEO::setByModel($model);

        $dataProvider=new ActiveDataProvider([
            'query'=>News::find()->where(['status'=>1]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);


        return $this->render('index', ['dataProvider' => $dataProvider,'model'=>$model]);
    }

    public function actionView($href)
    {
//        $model=News::findByHref($href)->one();

        $article=News::findByHref($href)->one();
        SEO::setByModel($article);

        return $this->render('view', ['article' => $article]);
    }

}