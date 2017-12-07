<?
    $breadcrumbs[]=['link'=>'cart/index','label'=>'YOUR SHOPPING CART'];
    $bundle = \app\assets\AppAsset::register($this);
?>
<section>
    <div class="padd-cont-02">
        <?=\yii\widgets\Breadcrumbs::widget(['links' => $breadcrumbs])?>
        <div style="clear:both;"></div>
        <div class="shop-left">
            <div style="clear:both; height:54px;"></div>
            <div class="basket-img">YOUR SHOPPING CART</div>
            <div style="clear:both; height:54px;"></div>
        </div>
        <div class="shop-right">
            <a href="#" class="img-shop-bl">
                    	<span class="img-shop-ab">
                        	<span class="choosw-fit">CHOOSE YOUR <br><span class="lin-bl">RIGHT FIT</span></span>
                            <span class="choose-fr">STARTING FROM $10</span>
                            <span style="clear:both; display:block;"></span>
                        </span>
                <span class="img-shop-card"><img src="<?=$bundle->baseUrl?>/images/img-shop-card.png" alt=""></span>
            </a>
        </div>
        <div style="clear:both; height:40px;"></div>
        <div class="bord-red">
            <div class="errop-title">erroR!</div>
            <div class="line-red"></div>
            <div class="padd-red">
                <img src="<?=$bundle->baseUrl?>/images/error-img.png" alt="">
                <div style="clear:both; height:25px;"></div>
                <? if(!$error_message){ ?>
                    There was an error processing your card. Don’t Worry!,<br> you’re not Charged this time. Please try again Later.<br> We’ll look into this!...
                <? }else echo $error_message; ?>
                <div style="clear:both; height:50px;"></div>
                meanwhile....
                <div style="clear:both; height:35px;"></div>
                <a href="<?=\yii\helpers\Url::to(['category/index'])?>" class="pink-btn">Browse Our Products</a>
                <div style="clear:both; height:80px;"></div>
                <a href="<?=\yii\helpers\Url::to(['site/contact'])?>" class="cont-support">Contact Support</a>
                <span class="prob">if the problem continues...</span>
                <div style="clear:both;"></div>
            </div>
        </div>
        <div style="clear:both; height:27px;"></div>
    </div>
</section>