<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class eStoreCartProduct extends Model{
    public $id,$product,$qty,$tax;

    public function getPrice(){
        if($this->product->isSale) return $this->product->getPrice($this->qty,2);
        return $this->product->getPrice($this->qty,0);
    }

    public function getSubTotalPrice($format = true){
        if($format === true){
            return number_format(((string)$this->price)*$this->qty,2,'.',',');
        }else{
            return ((string)$this->price)*$this->qty;
        }
    }

    public function increaseQty($qty=0){
        $qty=(int)$qty;
        $this->qty+=$qty;
    }

    public function setQty($qty=0){
        $qty=(int)$qty;
        $this->qty=$qty;
    }

}