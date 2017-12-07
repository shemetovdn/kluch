<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class CategoryParameter extends Model{
    public $title,$id,$options;

    public function rules()
    {
        return [
            [[
                'title','id','options'
            ],'safe'],
        ];
    }

}