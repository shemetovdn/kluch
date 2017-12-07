<?php
use backend\assets\AppAsset;
use yii\helpers\Html;


    \backend\assets\CleanUIAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
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

    <?=$content ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
