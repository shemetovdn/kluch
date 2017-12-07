<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class ProductsParameter extends Model{
    public $title,$value,$category_parameter_id,$categoryTitle,$imagePath;

    public function rules()
    {
        return [
            [[
                'title','value','category_parameter_id','categoryTitle','imagePath'
            ],'safe'],
        ];
    }

}