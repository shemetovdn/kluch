<?php

namespace frontend\widgets\questionWidget;

use frontend\models\OrderPropertyManagment;

class QuestionWidget extends \yii\base\Widget {

    public function run()
    {

        $model = new OrderPropertyManagment(['scenario' => OrderPropertyManagment::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget', ['model' => $model]);
    }
}