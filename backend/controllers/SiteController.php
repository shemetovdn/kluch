<?php
namespace backend\controllers;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public function actionIndex(){
        return $this->redirectToAvailableModule();
        return $this->redirect(['dashboard/default/index']);
    }

}
