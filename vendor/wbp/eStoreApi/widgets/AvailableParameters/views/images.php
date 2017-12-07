<div class="colorsWidget" id="<?=$id?>">

    <?=\yii\helpers\Html::hiddenInput($name,0)?>
    <?=\yii\helpers\Html::hiddenInput('products[]','')?>

    <div class="it-code-colorcodes"><b><?=$title?></b></div>
    <div style="clear:both; height:5px;"></div>
    <?
        foreach($parameters as $image){

    ?>
            <a class="color-choose" data-val="<?=$image['id']?>" data-products="<?=implode(',',$image['availableProducts'])?>">
                <img alt="" width="35" src="<?=$image['imagePath']?>">
            </a>
    <?
        }
    ?>
    <div style="clear:both; height:15px;"></div>
</div>