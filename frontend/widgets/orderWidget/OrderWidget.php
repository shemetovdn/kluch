<?php

namespace frontend\widgets\orderWidget;

use frontend\models\OrderPropertyManagment;

class OrderWidget extends \yii\base\Widget {

    public function run()
    {
        $model = new OrderPropertyManagment(['scenario' => OrderPropertyManagment::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget', ['model' => $model]);
    }
}