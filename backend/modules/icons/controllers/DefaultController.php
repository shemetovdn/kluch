<?php
namespace backend\modules\icons\controllers;

use backend\controllers\OneModelBaseController;

class DefaultController extends OneModelBaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
