<?php

namespace frontend\widgets\mainFilterWidget;

//use frontend\models\Callback;


class MainFilterWidget extends \yii\base\Widget {

    public function run()
    {
//        $model = new Callback(['scenario' => Callback::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget');
    }
}