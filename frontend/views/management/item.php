<?php
use frontend\assets\ImageAsset;
use yii\helpers\Url;

$bundle = ImageAsset::register($this);


?>

<a href="<?=Url::to(['management/index', 'href'=>$model->href])?>">
    <div class="option-img">
        <img src="<?=$model->image->getUrl()?>" alt="">
    </div>
    <div class="option-name">
        <?=$model->title?>
    </div>
</a>