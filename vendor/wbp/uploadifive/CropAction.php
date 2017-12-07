<?php

namespace wbp\uploadifive;

use wbp\images\models\Image;
use wbp\images\widgets\ImageCroper;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class CropAction extends \yii\base\Action
{
    public $type;
    public $itemId;

    public function run()
    {
        $content = ImageCroper::widget([
            'type'=>$this->type,
            'itemId'=>$this->itemId
        ]);

        $content="<div style='width: 600px;margin: 0 auto;'>$content</div>";
        
        return $this->controller->renderContent($content);
    }


}
