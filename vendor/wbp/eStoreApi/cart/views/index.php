<?
\wbp\ajaxer\AjaxerAsset::register($this);
\yii\widgets\PjaxAsset::register($this);
$bundle = \app\assets\AppAsset::register($this);

$breadcrumbs[]=['link'=>'cart/index','label'=>'YOUR SHOPPING CART'];

?>

    <div style="clear:both;"></div>
    <div class="container">
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
                        <span class="img-shop-card"><img src="<?= $bundle->baseUrl ?>/images/img-shop-card.png" alt=""></span>
                    </a>
                </div>
                <div style="clear:both; height:35px;"></div>
                <div class="shop-left">
                    <div class="bord-shop">
                        <div class="your-cart">YOUR CART</div>
                        <div class="line-grey"></div>

                        <?=
                            \yii\widgets\ListView::widget([
                                'dataProvider' => $products,
                                'itemView' => 'cartItem',
                                'layout' => '{items}'
                            ]);
                        ?>

                        <div class="bl-sh-cart">
                            <div class="sh-i"><img src="<?= $bundle->baseUrl ?>/images/i-sh.png" alt=""></div>
                            <div class="sh-text">You will be able to review the details of your Order Total at the right
                                before you Place Order.
                            </div>
                            <div style="clear:both; height:25px;"></div>
                            <div class="price-merch" data-price="subtotal">
                                $<?= Yii::$app->eStoreCart->getTotal() ?></div>
                            <div class="merch-sub">MERCHANDISE SUBTOTAL</div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <div style="clear:both; height:20px;"></div>
                    <a href="#" class="img-shop-bl">
                    	<span class="img-shop-ab sh-bot-l">
                        	<span class="choosw-fit">CHOOSE YOUR <br><span class="lin-bl">RIGHT FIT</span></span>
                            <span class="choose-fr">STARTING FROM $10</span>
                            <span style="clear:both; display:block;"></span>
                        </span>
                        <span class="img-shop-card"><img src="<?= $bundle->baseUrl ?>/images/img-shop-card-02.png"
                                                         alt=""></span>
                    </a>
                    <div style="clear:both; height:13px;"></div>
                    <div class="numb-bord">CALL U.S. OR CANADA (800) 411-5116</div>
                </div>
                <div class="shop-right">
                    <?
                        if(Yii::$app->user->id)
                            echo $this->render(Yii::$app->controller->viewsPath.'payCartForm',[
                                'paymentMethods'=>$paymentMethods,
                                'billingAddress'=>$billingAddress,
                                'shippingAddress'=>$shippingAddress
                            ]);
                        else
                            echo $this->render(Yii::$app->controller->viewsPath.'loginCartForm',[
                                'loginFormModel'=>$loginForm
                            ]);

                    ?>
                </div>
                <div style="clear:both; height:60px;"></div>
            </div>
        </section>
    </div>