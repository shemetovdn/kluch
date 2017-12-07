<?php

namespace frontend\widgets\otherFilterWidget;

//use frontend\models\Callback;


class OtherFilterWidget extends \yii\base\Widget {
    public $model;

    public function run()
    {
//        $model = new Callback(['scenario' => Callback::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget',["model" => $this->model]);
    }
}