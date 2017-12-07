<?

use backend\widgets\Menu;

$bundle=\backend\assets\CleanUIAsset::register($this);
    $bundleFrontend=\backend\assets\FromtendImagesAsset::register($this);
?>
<style>
    .logo-container svg{
        width: 200px;
    }
</style>
<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="<?=\yii\helpers\Url::to(['/site/index'])?>" class="logo">
            <?=file_get_contents($bundleFrontend->sourcePath.'/svg-png/logo.svg')?>
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <?
            echo Menu::widget([
                'linkTemplate' => '<a class="left-menu-link" href="{url}">{i}<span class="menu-top-hidden">{label}</span></a>',
                'activateParents' => true,
                'activeCssClass' => 'left-menu-list-active',
                'options'=>[
                        'class'=>'left-menu-list left-menu-list-root list-unstyled'
                ],
                'items' => Yii::$app->controller->menuItems,
            ]);
        ?>
    </div>
</nav>