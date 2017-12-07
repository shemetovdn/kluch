<div class="bl-sh-cart">
    <div class="bl-sh-l">
        <? if(!$model->product->thumbPath){ // getImage(false)?>
            <img class="thumb" src="data:ima-ge/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAADCklEQVR4Xu3b20sqYRQF8O1DCuI1vORDlllGkWL1//8FRqUYWpZ5ifCCCmGikXnYG3o4gR2OiwGF5UtjM+tj/LH2N77oGg6HC+FrZQEXAVe2syABMT8Cgn4EJCAqAOa5BxIQFADjbCABQQEwzgYSEBQA42wgAUEBMM4GEhAUAONsIAFBATDOBhIQFADjbCABQQEwzgYSEBQA42wgAUEBMM4GEhAUAONsIAFBATDOBhIQFADjbCABQQEwzgauM+BisZDHx0d5eXmR+XwuXq9XTk9PJRQK2W03m02p1+t2zu/32zn9+9vLiTURQ0cb2O/3pVwuSzgcllQqJcViUTwej1xcXMhkMrH3wWBQ9vf37Vjx8vm8uFyupZ/JiTXXFrDRaFgDDw8PZWdnR66vr+Xz89MAB4OB1Go1OTo6kr29PSkUCjKdTuX8/FwUSZsZjUYte3t7ay3N5XIyGo1WWtPn8yFOS7OONlA/rDZLRzaZTFobdYwVqVqtSq/Xk5OTE8PV6/T6s7Mzu16xtaWBQMD+ry1Np9N2vMqakUhk8wB1v3p4eJB2u20373a7JZvN2kjf3d39BfjzfafTkUqlYs3T9lxeXsrW1pYgazoh6GgDX19frWnaMG2QjqIC6AjriC5roLZFR/3q6krG47G1N5PJ2OdH1tw4wJ+tKpVKtvfp2M5ms6V7oDbu+fnZkBVcHzy6/+kDB1lz4wBbrZYhxeNxOTg4sAZ+fX3ZHvjx8WF7mY7z9zmF06fw+/u73Nzc2NM4FovZFrC9vW3n9HiVNX97siOwjo6wYt3f34vuZ7qXaZN0FBVUX4rx9PRk4/r9PVARtWXdbtdgd3d3Df7t7U2Oj48lkUj895r/+m65toDIjW1K1tEGbgoCcp8ERPT4Y0NQj4AExAXAFbgHEhAUAONsIAFBATDOBhIQFADjbCABQQEwzgYSEBQA42wgAUEBMM4GEhAUAONsIAFBATDOBhIQFADjbCABQQEwzgYSEBQA42wgAUEBMM4GEhAUAONsIAFBATDOBhIQFADjfwCVH/c/B7dXqwAAAABJRU5ErkJggg=="
                 alt="141x189" data-src="holder.js/141x189" style="width: 141px; height: 189px;">
        <? }else{ ?>
            <img class="thumb" src="<?=$model->product->thumbPath?>" style="width: 141px;"/>
        <? } ?>
    </div>
    <div class="bl-sh-r">
        <div class="bl-sh-tit"><?=$model->product->title?></div>
        <div style="clear:both; height:5px;"></div>
        <div class="l-dh">CODE :</div>
        <div class="r-dh"><?=$model->product->upc_code?></div>
        <div style="clear:both; height:5px;"></div>
        <?
        foreach((array)$model->product->parameters as $par){
            ?>
            <div class="l-dh"><?= $par->categoryTitle?></div>
            <div class="r-dh"><?= $par->title?></div>
            <div style="clear:both; height:5px;"></div>
        <? } ?>
        <div class="l-dh">Qty</div>
        <input type="number" name="cart-qty" step="1" min="1" data-item-id="<?=$model->product->id?>" value="<?=$model->qty?>" class="input-block-level form-control">
        <div style="clear:both; height:5px;"></div>
        <div class="sh-rig">
            <div class="pink-top-price" data-price-type="position" data-item-num="<?=$key?>" >$<?=$model->subTotalPrice?></div>
            <div class="pink-top-price" data-price-type="item" data-item-num="<?=$key?>" >$<?=$model->price?></div>
            <a class="bin ajax" href="<?=Yii::$app->urlManager->createUrl(['cart/remove-from-cart', 'id'=>$model->product->id])?>" data-ajax-result="append" data-ajax-target="body" data-ajax-hidemask="yes" onclick="$(this).parent().parent().remove();">REMOVE</a>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<div class="line-grey"></div>
