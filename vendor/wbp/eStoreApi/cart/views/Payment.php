<?
    $bundle = \app\assets\AppAsset::register($this);

    $this->registerJs("
        $('[name=payment_method]').change(function(){
            $('.blcok_pay').hide();
            $('.blcok_pay input.selector').val('0');
            console.log($('.block_pay input.selector').length);
            $('#payForm_'+$(this).val()).show();
            $('#payForm_'+$(this).val()+' input.selector').val('1');

        });
        $('[name=payment_method]').eq(0).attr('checked','checked').change();
    ",\yii\web\View::POS_END);
?>
<div class="sh_dawn_menu">
    <div class="sh-but_menu">
        <div class="sh_title_menu">
            <div class="faq-text">2. PAYMENT OPTIONS</div>
            <div class="faq-ar"><img src="<?=$bundle->baseUrl ?>/images/arrow-lin.png" alt=""/>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="sh_drop_dawn">
        <div style="clear:both; height:22px;"></div>
        <div class="pay-l">PAYment<br> type</div>
        <? foreach($paymentMethods as $method){ ?>
            <div class="pay-r">
                <input name="payment_method" value="<?=$method->id?>" id="check<?=$method->id?>" type="radio"/>
                <label class="qwe1" for="check<?=$method->id?>">
                    <span class="ch"></span>
                    <span class="lh2"><?=$method->getTitle()?></span>
                </label>
            </div>
        <? } ?>

        <div style="clear:both; height:20px;"></div>
        <? foreach($paymentMethods as $method){ ?>
                <div class="blcok_pay" id="payForm_<?=$method->id?>">
                    <?=$method->getPaymentForm($this,$form)?>
                </div>
        <? } ?>
    </div>
</div>
<!-- -->