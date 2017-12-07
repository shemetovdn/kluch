<?
$bundle = \frontend\assets\ImageAsset::register($this);
?>

<div class="bgyelloy">
    <div class="container">
        <img class="optimizer" src="<?=$bundle->baseUrl?>/images/07-404page-1170_03.png" alt="">
        <div class="nofound"><?= Yii::t('app', 'Page Not Found') ?></div>
        <?= \yii\helpers\Html::a(Yii::t('app', 'Return Home'), ['site/index'], ['class' => 'btn']); ?>
    </div>
</div>