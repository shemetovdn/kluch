<?php
/**
 * Created by PhpStorm.
 ** User: Home alexeymarkov.x7@gmail.com
 *** Date: 23.03.2016
 **** Time: 15:02
 */

namespace vendor\wbp\crop;


use yii\base\Widget;
use yii\helpers\Html;

class CropImage extends Widget
{
    public $url;
    public $sourceUrl;


    public function run()
    {
        $return = Html::img($this->url, ['data-crop' => 'true']);
        return $return;
    }
}