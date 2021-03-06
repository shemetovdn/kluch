<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 20.01.2016
 * Time: 13:50
 */

namespace frontend\controllers;

use backend\modules\pages\models\Pages;
use backend\modules\seo\models\SEO;
use common\models\WbpActiveRecord;
use Yii;
use yii\web\Controller;

//use backend\modules\subscribe\models\Subscribe;
//use backend\modules\subscribe\models\Subscribe;

class BaseController extends Controller
{
    public $page;
    public $support;
    public $subMenu;
    public $breadcrumbs = [];


    public function beforeAction($action)
    {
//        $this->modelSubscribe = new Subscribe(['scenario' => Subscribe::FRONTEND_SUBSCRIBE]);
//        $this->modelSubscribe->return = $_SERVER['REQUEST_URI'];

        $href = $action->id;

        if ($href == 'generic-page' && isset($_GET['href'])) $href = $_GET['href'];
        if (Yii::$app->controller->id != 'site') $href = Yii::$app->controller->id;

        $this->page = Pages::find()->where([
            'href' => $href,
            'status' => 1,
        ])->one();

        if (!$this->page)
            $this->page = new Pages();
        else {
            SEO::setByModel($this->page);
        }

        if ($this->page->parent_page > 0) {
            $this->parent_page = Pages::findOne(['id' => $this->page->parent_page, 'status' => WbpActiveRecord::STATUS_ACTIVE]);
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function render($view, $params = [])
    {
        SEO::setMetaTags();
        return parent::render($view, $params); // TODO: Change the autogenerated stub
    }

}