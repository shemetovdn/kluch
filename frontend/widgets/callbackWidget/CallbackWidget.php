<?php

namespace frontend\widgets\callbackWidget;

use frontend\models\Callback;


class CallbackWidget extends \yii\base\Widget {

    public function run()
    {
        $model = new Callback(['scenario' => Callback::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget', ['model' => $model]);
    }
}