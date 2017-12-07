<?php
use backend\assets\AppAsset;
use backend\widgets\Menu;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this \yii\web\View */
/* @var $content string */

$bundle = \backend\assets\CleanUIAsset::register($this);

$this->registerJs(' setInterval(function(){$.post("",{logOnly:true})},20000); ', yii\web\View::POS_END);?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>"><!-- <![endif]-->

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="theme-default">
<?php $this->beginBody() ?>
<?= \wbp\uniqueOverlay\UniqueOverlay::body() ?>
<?
$alert = '';
$flashes = Yii::$app->session->getAllFlashes();
foreach ($flashes as $flashType => $fl) {
    foreach ((array)$fl as $flash) {

        $alert .= <<<JS
            $.notify({
                title: '',
                message: '{$flash}'
            },{
                type: '{$flashType}'
            });
JS;
    }

}
$this->registerJs($alert, yii\web\View::POS_END);
?>

<?=$this->render('left-menu')?>
<?=$this->render('top-menu')?>
<section class="page-content">
    <div class="page-content-inner">
        <?=$content?>
    </div>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
