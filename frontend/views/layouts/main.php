<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\modules\management\models\Management;
use frontend\widgets\callbackWidget\CallbackWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use backend\modules\services\models\Services;

$session = Yii::$app->session;
$bundle = \frontend\assets\AppAsset::register($this);

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
<!--    <link rel="icon" href="/images/favicon.ico">-->
    <style>

        select.multi-select{
            display: none;
        }
    </style>
    <?php $this->head() ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5H6TKRD');</script>
    <!-- End Google Tag Manager -->
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5H6TKRD"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<?php $this->beginBody() ?>


<header>
    <div class="header-grey-left-block hidden-xs hidden-sm"></div>
    <div class="header-lines-right-block hidden-xs hidden-sm"></div>
    <div class="container">
        <div class="row">
            <div class="header-logo hidden-xs hidden-sm col-md-2 col-lg-2">
                <a href="<?=Url::to(['site/index'])?>">
                    <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-header-3x.png" alt="">
                </a>
            </div>
            <div class="header-body col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <div class="header-top hidden-xs hidden-sm">
                    <div class="row">
                        <div class="header-title col-md-5 col-lg-5">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-header2-3x.png" alt="">
                        </div>
                        <div class="header-call-back col-md-7 col-lg-7">
                            <button class="button--isi button btn-radius pull-right" data-toggle="modal" data-target="#сallBackModal">
                                Обратный звонок
                            </button>
                            <div class="header-phones">
                                <div class="header-phone-item">
                                    <a href="tel:<?=\common\models\Config::getParameter('viber')?>"><?=\common\models\Config::getParameter('viber')?> <span>Viber</span></a>
                                </div>
                                <div class="header-phone-item">
                                    <a href="tel:<?=\common\models\Config::getParameter('phone')?>"><?=\common\models\Config::getParameter('phone')?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom">
                    <nav class="navbar">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header visible-xs visible-sm">
                            <button type="button" class="burger closed">
                                <div>
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </button>
                            <a class="navbar-brand" href="index.html"><img src="<?=$bundle->baseUrl?>/images/svg-png/logo-header-2x.png" alt=""></a>
                            <div class="mobile-header-title">
                                <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-header2-2x.png" alt="">
                            </div>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?=$this->render('menu')?>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
        </div>

    </div>
</header>

<?=$content?>

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2">
                    <div class="footer-logo">
                        <a href="<?=Url::to(['site/index'])?>">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-footer-3x.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    <div class="footer-lists">
                        <div class="row footer-buttons-row">
                            <div class="footer-top-col-3">
                                <a href="<?=Url::to(['site/request-for-sale'])?>" class="button--isi button btn-radius">Заявка на продажу</a>
                            </div>
                            <div class="footer-top-col-3">
                                <a href="<?=Url::to(['site/request-for-rent'])?>" class="button--isi button btn-radius">Заявка на аренду</a>
                            </div>
                            <div class="footer-top-col-4">
                                <a href="<?=Url::to(['site/can-not-find'])?>" class="button--isi button btn-radius">Не могу найти свой вариант</a>
                            </div>
                        </div>
                        <div class="row footer-menu">
                            <div class="footer-top-col-3 footer-menu-main">
                                <div class="footer-menu-title-col">
                                    <a class="hidden-xs">Продажа недвижимости</a>
                                </div>

                                <?
                                $menu_sale = [
                                    ['label' => 'Квартиры', 'url' => ['site/index']],
                                    ['label' => 'Квартиры в новостройках', 'url' => ['site/index']],
                                    ['label' => 'Частные дома', 'url' => ['site/index']],
                                    ['label' => 'Земельные участки', 'url' => ['site/index']],
                                    ['label' => 'Коммерческая недвижимость', 'url' => ['site/index']],
                                    ['label' => 'Дачи', 'url' => ['site/index']],
                                    ['label' => 'Гаражи', 'url' => ['site/index']],
                                    ['label' => 'Эллинги', 'url' => ['site/index']],
                                    ['label' => 'Эксклюзивная продажа', 'url' => ['site/index']],
                                    ['label' => 'Зарубежная недвижимость', 'url' => ['site/index']],
                                ];
                                $menu_sale = \backend\modules\objectTypes\models\ObjectTypes::getMenuItemsByCategory(1);

                                    echo Menu::widget([
                                        'items' => $menu_sale,
                                    ]);
                                ?>

                            </div>
                            <div class="footer-top-col-3">
                                <div class="footer-menu-title-col">
                                    <a class="hidden-xs">Аренда недвижимости</a>
                                </div>

                                <?
                                    echo Menu::widget([
                                        'items' => \backend\modules\objectTypes\models\ObjectTypes::getMenuItemsBuyLeaseMobail(),
                                    ]);
                                ?>

                                <div class="footer-menu-sub">
                                    <div class="footer-menu-sub-item">
                                        <a href="<?=Management::getUrlOnFirst()?>">Управление недвижимостью</a>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-top-col-4 footer-menu-options">
                                <div class="footer-menu-title-col">
                                    <a href="<?=Url::to(['services/index'])?>">Услуги</a>
                                </div>

                                <?
                                    echo Menu::widget([
                                        'items' => Services::getMenuItems(),
                                    ]);
                                ?>

                                <div class="footer-menu-sub">
                                    <div class="footer-menu-sub-item">
                                        <a href="<?=Url::to(['site/partners'])?>">Партнёры</a>
                                    </div>
                                    <div class="footer-menu-sub-item">
                                        <a href="<?=Url::to(['site/contact'])?>">Контакты</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row row-reverse">
                <div class="col-xs-12 col-sm-9 col-md-12 col-lg-12 footer-bottom-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 footer-realtors-enter">
                            <a href="/admin/">
                                Вход для риэлторов
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-social">
                            <a href="<?= \common\models\Config::getParameter('facebook')?>">
                                <img src="<?=$bundle->baseUrl?>/images/svg-png/facebook_3x.png" alt="">
                            </a>
                            <a href="<?= \common\models\Config::getParameter('vk')?>">
                                <img src="<?=$bundle->baseUrl?>/images/svg-png/vk_3x.png" alt="">
                            </a>
                            <a href="<?= \common\models\Config::getParameter('instagram')?>">
                                <img src="<?=$bundle->baseUrl?>/images/svg-png/inst_3x.png" alt="">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 footer-dev-site">
                            Разработка сайта —
                            <a href="http://www.studiomarka.com" target="_blank">
                                <img src="<?=$bundle->baseUrl?>/images/svg-png/marka@2x.png" alt="">
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 footer-copyright">
                            <?= \common\models\Config::getParameter('copyright')?>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom-logo col-xs-12 col-sm-3 hidden-md hidden-lg">
                    <div class="footer-logo">
                        <a href="<?=Url::to(['site/index'])?>">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-footer-3x.png" alt="" class="hidden-xs">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/mobile-footer-logo.png" alt="" class="hidden-sm">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer /-->

<?=CallbackWidget::widget()?>

<div class="mobile-menu">
    <button class="close-menu"><img src="<?=$bundle->baseUrl?>/images/svg-png/x-small-white.svg" alt=""></button>

    <ul class="nav">
        <li>
            <div class="mobile-menu-logo">
                <a href="<?=Url::to(['site/index'])?>">
                    <img src="<?=$bundle->baseUrl?>/images/svg-png/logo-header-3x.png" alt="">
                </a>
            </div>
        </li>
        <li>
            <div class="mobile-menu-phone">
                <div class="phone-item">
                    <a href="tel:<?=\common\models\Config::getParameter('viber')?>"><?=\common\models\Config::getParameter('viber')?> <sup>Viber</sup></a>
                </div>
                <div class="phone-item">
                    <a href="tel:<?=\common\models\Config::getParameter('phone')?>"><?=\common\models\Config::getParameter('phone')?></a>
                </div>
                <button class="button--isi button btn-radius" data-toggle="modal" data-target="#сallBackModal">
                    Обратный звонок
                </button>
            </div>
        </li>
        <?=$this->render('mobile-menu')?>
    </ul>
</div>

<?php
    Url::remember();
?>

<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
