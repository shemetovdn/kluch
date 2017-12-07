<?php
use backend\assets\AppAsset;
use backend\widgets\Menu;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this \yii\web\View */
/* @var $content string */

$bundle = AppAsset::register($this);

$this->registerJs(' setInterval(function(){$.post("",{logOnly:true})},20000); ', yii\web\View::POS_END);?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie lt-ie9 lt-ie8 lt-ie7" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 7]>
<html class="ie lt-ie9 lt-ie8" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 8]>
<html class="ie lt-ie9" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if gt IE 8]>
<html class="ie gt-ie8" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>"><!-- <![endif]-->

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= \wbp\uniqueOverlay\UniqueOverlay::body() ?>
<?
$alert = '';
$flashes = Yii::$app->session->getAllFlashes();
foreach ($flashes as $flashType => $fl) {
    foreach ((array)$fl as $flash) {

        $alert .= <<<JS
                notyfy({
                    text: '{$flash}',
                    type: '{$flashType}', // alert|error|success|information|warning|primary|confirm
                    timeout: 1500
                });
JS;
    }

}
$this->registerJs($alert, yii\web\View::POS_END);
?>

<div class="container fluid menu-left">

    <!-- Top navbar -->
    <div class="navbar main hidden-print">

        <!-- Brand -->
        <a href="<?= Yii::$app->getUrlManager()->createUrl('') ?>"
           class="appbrand pull-left"><span><?= \common\models\Config::getParameter('title') ?> </span></a>

        <!-- Menu Toggle Button -->
        <button type="button" class="btn btn-navbar">
            <span class="glyphicons show_lines"><i></i></span>
        </button>
        <!-- // Menu Toggle Button END -->

        <!-- Top Menu Right -->
        <ul class="topnav pull-right">

            <!-- Profile / Logout menu -->
            <li class="account">
                <a data-toggle="dropdown" href="<?= Yii::$app->getUrlManager()->createUrl('profile/default/index') ?>"
                   class="glyphicons logout lock"><span
                        class="hidden-sm text"><?= Yii::$app->user->identity->username ?></span><i></i></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('settings/default/index') ?>"
                           class="glyphicons cogwheel"><?= Yii::t('admin', 'Settings') ?><i></i></a></li>
                    <?
                    if (Yii::$app->getUser()->getIdentity()->is_super_admin) {
                        ?>
                        <li>
                            <a href="<?= Yii::$app->getUrlManager()->createUrl('moduleCreator') ?>"><?= Yii::t('admin', 'Module Creator') ?>
                                <i class="icon-building"
                                   style="float: right;margin-top: 8px;margin-right: 3px;"></i></a></li>
                    <? } ?>
                    <li class="highlight profile">
                        <span>
                            <span class="heading"><?= Yii::t('admin', 'Profile') ?> <a
                                    href="<?= Yii::$app->getUrlManager()->createUrl('profile/default/index') ?>"
                                    class="pull-right"><?= Yii::t('admin', 'edit') ?></a></span>
                            <img class="img" src="<?= Yii::$app->user->identity->getImage()->getUrl('47x45') ?>"/>
                            <span class="details">
                                <a href="<?= Yii::$app->getUrlManager()->createUrl('profile/default/index') ?>"><?= Yii::$app->user->identity->data->first_name ?> <?= Yii::$app->user->identity->data->last_name ?></a>
                                <?= Yii::$app->user->identity->email ?>
                            </span>
                            <span class="clearfix"></span>
                        </span>
                    </li>
                    <li>
                        <span>
                            <a class="btn btn-default btn-mini pull-right" data-method="post"
                               href="<?= Yii::$app->getUrlManager()->createUrl('site/logout') ?>"><?= Yii::t('admin', 'Sign Out') ?></a>
                        </span>
                    </li>
                </ul>
            </li>
            <!-- // Profile / Logout menu END -->

        </ul>
        <!-- // Top Menu Right END -->


    </div>
    <!-- Top navbar END -->

    <!-- Sidebar menu & content wrapper -->
    <div id="wrapper">

        <!-- Sidebar Menu -->
        <div id="menu" class="hidden-sm hidden-print">

            <!-- Scrollable menu wrapper with Maximum height -->
            <div class="slim-scroll" data-scroll-height="800px">

                <!-- Sidebar Profile -->
			<span class="profile">
				<a class="img" href="<?= Yii::$app->getUrlManager()->createUrl('profile/default/index') ?>"><img
                        src="<?= Yii::$app->user->identity->getImage()->getUrl('47x45') ?>"/></a>
				<span>
					<strong><?= Yii::t('admin', 'Welcome') ?></strong>
					<a href="<?= Yii::$app->getUrlManager()->createUrl('profile/default/index') ?>"
                       class="glyphicons right_arrow"><?= Yii::$app->user->identity->username ?> <i></i></a>
				</span>
			</span>
                <div class="clearfix"></div>

                <?
                echo Menu::widget([
                    'linkTemplate' => '<a href="{url}"><i></i><span>{label}</span></a>',
                    'activateParents' => true,
                    'items' => Yii::$app->controller->menuItems,
                ]);
                ?>
                <div class="clearfix"></div>

                <div class="separator bottom"></div>
                <!-- // Regular Size Menu END -->
            </div>
            <!-- // Scrollable Menu wrapper with Maximum Height END -->

        </div>
        <!-- // Sidebar Menu END -->

        <!-- Content -->
        <div id="content">

            <?
            echo Breadcrumbs::widget([
                'homeLink' => [
                    'label' => '<i></i>' . \common\models\Config::getParameter('title'),
                    'url' => Yii::$app->homeUrl,
                    'class' => "glyphicons home",
                    'template' => "<li>{link}</li>\n",
                ],
                'encodeLabels' => false,
                'itemTemplate' => "<li class=\"divider\"></li>\n<li>{link}</li>\n",
                'activeItemTemplate' => "<li class=\"divider\"></li>\n<li>{link}</li>\n",
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
            if (isset($this->params['breadcrumbs'])) echo '<div class="separator bottom"></div>';


            ?>

            <!--                <li><a href="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light" class="glyphicons home"><i></i> AdminKIT</a></li>-->
            <!--                <li class="divider"></li>-->
            <!--                <li>Online Shop</li>-->
            <!--                <li class="divider"></li>-->
            <!--                <li>Products</li>-->

            <?= $content ?>


        </div>
        <!-- // Content END -->

    </div>
    <div class="clearfix"></div>
    <!-- // Sidebar menu & content wrapper END -->


</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
