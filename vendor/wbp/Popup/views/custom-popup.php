<?php
/**
 * Created by PhpStorm.
 * User: Леха
 * Date: 05.07.2016
 * Time: 16:32
 */
$bundle = \frontend\assets\ImageAsset::register($this);

$this->registerJs('
    $("#custom-popup").overlay({
        // custom top position
        top: "10%",
        left: ($(window).width()-$("#custom-popup").width())/2,
        // some mask tweaks suitable for facebox-looking dialogs
        mask: {
         
            // you might also consider a "transparent" color for the mask
            color: \'#000\',
         
            // load mask a little faster
            loadSpeed: 200,
         
            // very transparent
            opacity: 0.5
        },
         load: true
    }).load();
');
?>
<div class="container" id="custom-popup" style="display: none;">
    <div class="popup-coll"><a class="close"><img src="<?= $bundle->baseUrl ?>/images/closerr.png" alt=""/></a>
        <div class="titlebox-1"><?= $model['title'] ?></div>
        <div class="line-silv-popup"></div>
    <p><?= $model['message'] ?></p></div>
</div>
