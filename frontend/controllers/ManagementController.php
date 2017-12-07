<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 25.02.2016
 * Time: 10:58
 */

namespace frontend\controllers;

use backend\modules\pages\models\Pages;
use backend\modules\management\models\Management;
use backend\modules\seo\models\SEO;
use yii\data\ActiveDataProvider;
use frontend\models\OrderPropertyManagment;

class ManagementController extends BaseController
{

    public function actionIndex($href)
    {

        $model = Management::findByHref($href)->one();
        SEO::setByModel($model);

        $propertys = new ActiveDataProvider([
            'query' => Management::find()->where(['status'=>1])->orderBy('created_at'),
            'pagination' => false,
        ]);

        return $this->render('index', ['model'=>$model, 'propertys'=>$propertys]);
    }

}