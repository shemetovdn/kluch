<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class ProductsPrice extends Model{
    public $id,$price,$qty_start,$qty_end,$member_price;

    public function rules()
    {
        return [
            [[
                'id','price','qty_start','qty_end','member_price'
            ],'safe'],
        ];
    }

    public function __toString(){
        return $this->price;
    }
}