<?
    $breadcrumbs[]=['link'=>'cart/index','label'=>'YOUR SHOPPING CART'];
    $homeUrl=\yii\helpers\Url::to(['site/index']);
    $this->registerJs("
        var time=30;
        $('#time').html(time);
        setInterval(function(){
            time--;
            if(time<0) time=0;
            $('#time').html(time);
            if(time==0) document.location.href='".$homeUrl."';
        },1000);
    ",\yii\web\View::POS_END);
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
        <div style="clear:both; height:55px;"></div>
        <div class="suc">hot payment successfull!!!</div>
        <div style="clear:both; height:30px;"></div>
        <div class="bg-green">
            <img src="<?=$bundle->baseUrl?>/images/suc-vector.png" alt="">
            <div style="clear:both; height:40px;"></div>
            <div class="bg-green-tit">Thank You!</div>
            <div style="clear:both; height:15px;"></div>
            Your Oreder has been processed and a confirmation has<br> been sent to your e-mail.
            <div style="clear:both; height:30px;"></div>
            <?if($order_id){?><span class="order-no">Order No: #<?=$order_id?></span><?}?>
            <div style="clear:both; height:35px;"></div>
            <a class="pink-btn" href="<?=\yii\helpers\Url::to(['category/index'])?>">Browse Our Products</a>
            <div style="clear:both; height:90px;"></div>
            <div class="text-center">You are being Re-directed to the home page in <span id="time"></span> Secs... </div>
        </div>
        <div style="clear:both; height:27px;"></div>
    </div>
</section>