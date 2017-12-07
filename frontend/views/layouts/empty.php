<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$session = Yii::$app->session;
$bundle = \frontend\assets\OrderAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="shortcut icon" href="<?=$bundle->baseUrl?>/images/favicon.ico">
    <link rel="icon" href="<?=$bundle->baseUrl?>/images/favicon.ico">

    <?php $this->head() ?>
</head>
<body>

<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
