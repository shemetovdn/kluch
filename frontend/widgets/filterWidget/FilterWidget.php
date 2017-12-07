<?php

namespace frontend\widgets\filterWidget;

//use frontend\models\Callback;


class FilterWidget extends \yii\base\Widget {
    public $category_id;
    public $object_id;
    public $filter_params;

    public function run()
    {
//        $model = new Callback(['scenario' => Callback::FRONTEND_ADD_SCENARIO]);
        return $this->render('widget',['category_id'=> $this->category_id, 'object_id'=> $this->object_id, "filter_params" =>$this->filter_params]);
    }
}