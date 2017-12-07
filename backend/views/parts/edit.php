<?php
    use yii\helpers\Html;
?>

<section class="panel">
    <div class="panel-heading">
        <h3 class="pull-left"><?=$title?></h3>
        <div class="buttons pull-right">
            <? if($add)  echo Html::a('<i class="icmn-plus3"></i> '. $add, ['add'],['class'=>'btn btn-primary'])?>
            <? if($delete) echo  \wbp\widgets\RemoveButton::widget([
                'linkOptions'=>[
                    'text' => '<i class="icmn-bin"></i> ' . Yii::t('admin', 'Remove'),
                    'url' => ['remove','id'=>$delete],
                    'options' => ['class'=>'btn btn-danger']
                ],
                'ajax'=>false
            ]);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <?=$form?>
</section>