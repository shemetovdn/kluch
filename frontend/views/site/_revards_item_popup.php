<?php
    $bundle = \frontend\assets\ImageAsset::register($this);
?>

<div class="modal fade modalRewards" id="modalRewards_<?=$model->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="modalClose" data-dismiss="modal"><img src="<?=$bundle->baseUrl?>/images/svg-png/x-big.svg" alt=""></button>
            <div class="row">
                <div class="col-xs-6 modal-image-part">
                    <img src="<?=$model->image->getUrl()?>" alt="">
                </div>
                <div class="col-xs-6 modal-desc-part">
                    <div class="reward-name">
                        <?=$model->title?>
                    </div>
                    <div class="reward-desc">
                        <?=$model->description?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>