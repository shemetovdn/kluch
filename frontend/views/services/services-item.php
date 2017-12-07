<?php
    use yii\helpers\Url;
?>


<div class="dv_services_item">
    <span class="img_wrapper">
        <a href="<?=Url::to(['services/view', 'href'=>$model->href])?>">
            <img class="img_box" src="<?=$model->image->getUrl()?>" alt="">
        </a>
    </span>
    <div class="ser-title">
        <a href="<?=Url::to(['services/view', 'href'=>$model->href])?>">
            <?=$model->title?>
        </a>
    </div>
</div>
