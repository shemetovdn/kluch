<?php
    $bundle = \frontend\assets\ImageAsset::register($this);
?>

<a href="#" data-toggle="modal" data-target="#modalRewards_<?=$model->id?>">
    <img src="<?=$model->image->getUrl()?>" style="max-width: 80px; max-height: 74px;" alt="">
<!--    --><?//=$model->image->getUrl()?>
</a>