<?php

namespace backend\modules\dashboard\controllers;

use backend\controllers\BaseController;
use backend\models\UserLog;
use backend\modules\adverts\models\Views;
use backend\modules\categories\models\Category;
use common\models\DevicesLog;
use Yii;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\web\NotFoundHttpException;

class DefaultController extends BaseController
{
    public function actionIndex(){
        $logAll = new ActiveDataProvider([
            'query' => UserLog::find()->orderBy('id desc')->limit(10),
            'key' => 'id',
            'pagination' => false,
        ]);
        $logAdd = new ActiveDataProvider([
            'query' => UserLog::find()->where(['additional_options'=>UserLog::ADDED])->orderBy('id desc')->limit(10),
            'key' => 'id',
            'pagination' => false,
        ]);
        $logRemove = new ActiveDataProvider([
            'query' => UserLog::find()->where(['additional_options'=>UserLog::REMOVED])->orderBy('id desc')->limit(10),
            'key' => 'id',
            'pagination' => false,
        ]);
        $logEdit = new ActiveDataProvider([
            'query' => UserLog::find()->where(['additional_options'=>UserLog::SAVED])->orderBy('id desc')->limit(10),
            'key' => 'id',
            'pagination' => false,
        ]);
        $logAccess = new ActiveDataProvider([
            'query' => UserLog::find()->where(['additional_options'=>UserLog::ACCESS_DENIED])->orderBy('id desc')->limit(10),
            'key' => 'id',
            'pagination' => false,
        ]);

        $views_per_day=Views::find()->where(['>=','created_at',time()-24*3600])->count();
        $views_per_week=Views::find()->where(['>=','created_at',time()-7*24*3600])->count();

        $days=5;
        $chart=[];
        $chart['data']=[];
        $categories=Category::find()->all();
        for ($i=$days-1;$i>=0;$i--){
            $time=time()-$i*24*3600;
            $chart['labels'][$i]=date("d/m",$time);
            foreach ($categories as $category){
                if(!isset($chart['data'][$category->id])) $chart['data'][$category->id]=[];
                $chart['data'][$category->id][$i]=Views::find()
                    ->leftJoin('{{%adverts}}', '{{%adverts}}.`id` = {{%views}}.`advert_id`')
                    ->where(['>=','{{%views}}.`created_at`',date('Y-m-d 00:00:00', $time)])
                    ->andWhere(['<=','{{%views}}.`created_at`',date('Y-m-d 23:59:59', $time)])
                    ->andWhere(['{{%adverts}}.`category_id`'=>$category->id])
                    ->count();
            }
        }

        foreach ($categories as $category){
            $chart['data'][$category->id]=implode(',', $chart['data'][$category->id]);
        }
        $chart['data']='['.implode('],[', $chart['data']).']';


        return $this->render('index',[
            'logAll'=>$logAll,
            'logAdd'=>$logAdd,
            'logRemove'=>$logRemove,
            'logEdit'=>$logEdit,
            'logAccess'=>$logAccess,
            'views_per_week'=>$views_per_week,
            'views_per_day'=>$views_per_day,
            'chart'=>$chart,
            'categories'=>$categories
        ]);
    }

    public function actionLoginAsUser($id)
    {
        $user=User::findOne(['id'=>$id]);
        if(!$user){
            throw new NotFoundHttpException('User Not found');
        }
        if(!Yii::$app->user->identity->is_super_admin){
            throw new NotFoundHttpException('Permission denied');
        }

        Yii::$app->session->set('old-__id',$_SESSION["__id"]);

        Yii::$app->user->login($user);
        return $this->redirect('/admin');
    }
}


