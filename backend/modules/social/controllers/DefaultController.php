<?php

namespace backend\modules\social\controllers;

use backend\controllers\BaseController;
use backend\modules\social\models\Social;
use backend\modules\social\models\SocialDB;
use common\models\Config;
use Yii;

class DefaultController extends BaseController
{

    public function init()
    {
        $this->FormModel = Social::className();
        $this->ModelName = SocialDB::className();

        return parent::init();
    }

    public function actionIndex()
    {
        $available = ['facebook', 'vk', 'instagram',/*'linkedin',  'twitter', 'pinterest','vk','skype','google_plus', 'facebook_app_id', 'facebook_api_secret', 'twitter_api_key', 'twitter_api_secret'*/];
        $widgets = [];//['facebook_widget', 'twitter_widget'];
        $query = SocialDB::find()->where([
                'name' => $available,
            ]
        )->orderBy('id ASC');

        if (Yii::$app->request->post()) {
            foreach (Yii::$app->request->post() as $key => $value) {
                if(in_array($key, $available) || in_array($key, $widgets)){
                    Config::setParameter($key, $value);
                }
            }
        }

        $model['links'] = $query->all();
//        $model['facebook_widget'] = SocialDB::find()->where(['name' => 'facebook_widget'])->one();
//        $model['twitter_widget'] = SocialDB::find()->where(['name' => 'twitter_widget'])->one();

        return $this->render('index', ['model' => $model]);
    }


}
