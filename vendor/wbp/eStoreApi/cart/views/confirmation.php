<?
    $bundle=\app\assets\AppAsset::register($this);
?>
<div class="bg_mess" style="width: 600px;">
    <div class="blok_padd">
        <div class="closer close" onclick="uniqueOverlay.close();"><img src="<?=$bundle->baseUrl?>/images/closer.png" alt="" /></div>
        <div style="clear:both; height:5px;"></div>
        <img src="../images/pink_impotent.png" alt="" />
        <div style="clear:both; height:24px;"></div>
        WOULD YOU LIKE TO<br> REVIEW YOUR ORDER<br> BEFORE YOU PROCEEED<br>
        TO PAYMENT?
        <div style="clear:both; height:24px;"></div>
        <a href="#" class="pink-btn" onclick="uniqueOverlay.close();">GO BACK & REVIEW</a>
        <div style="clear:both; height:20px;"></div>
    </div>
    <div class="block_blue">
        <div class="blok_padd">
            NO, I’M COOL! - LET’S<br> PROCEED TO PAYMENT...
            <div style="clear:both; height:24px;"></div>
            <a href="#" class="wh-btn" onclick="confirmation=true; $('#billing-form').submit();return false;">PROCEED</a>
            <div style="clear:both; height:20px;"></div>
        </div>
    </div>
</div>

<?=\wbp\uniqueOverlay\UniqueOverlay::script()?>