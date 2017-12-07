
<div class="partner-img">
    <img src="<?=$model->image->getUrl()?>" alt="">
</div>
<div class="partner-info">
    <div class="partner-info-top">
        <div class="partner-info-name">
            <?=$model->first_name?> <?=$model->last_name?>
        </div>
        <div class="partner-info-position">
            <?=$model->position?>
        </div>
    </div>
    <div class="partner-info-bottom">
        <div class="partner-info-phone">
            <?=$model->phone?>
        </div>
        <div class="partner-info-email">
            <?=$model->email?>
        </div>
    </div>
</div>