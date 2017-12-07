<?php

namespace frontend\widgets\mapFilterWidget;

//use frontend\models\Callback;


class MapFilterWidget extends \yii\base\Widget {

    public function run()
    {
//        $model = new Callback(['scenario' => Callback::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget');
    }
}