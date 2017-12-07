<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class eStoreImage extends Model
{
    public $id, $item_id, $type, $ext, $width, $height;

    public function rules()
    {
        return [
            [[
                'id', 'item_id', 'type', 'ext', 'width', 'height'
            ], 'safe'],
        ];
    }

    public function getUrl($size = false, $method = 1)
    {
        $data = [
            'item='.$this->id,
            'size='.$size,
            'method='.$method
        ];
        return \Yii::$app->eStore->apiUrl . 'images/image-by-item?'.implode('&',$data);


    }

    public function __toString()
    {
        return $this->getUrl();
    }

}