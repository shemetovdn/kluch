<div class="selectWidget" id="<?=$id?>">

    <?=\yii\helpers\Html::hiddenInput('products[]','')?>

    <div class="it-code-colorcodes"><b><?=$title?></b></div>
    <div style="clear:both; height:5px;"></div>
        <select name="<?=$name?>" style="width: 100%;height: 30px;">
            <option value="" data-products="">Select</option>
            <?
                foreach($parameters as $parameter){

            ?>
                    <option value="<?=$parameter['id']?>" data-products="<?=implode(',',$parameter['availableProducts'])?>"><?=$parameter['title']?></option>
            <?
                }
            ?>
        </select>
    <div style="clear:both; height:15px;"></div>
</div>