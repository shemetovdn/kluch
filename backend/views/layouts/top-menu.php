<?php
    $this->registerJs('
        var topMenuChart = $("#topMenuChart").peity("bar", {
            fill: [\'#01a8fe\'],
            height: 22,
            width: 44
        });

        setInterval(function() {
            var random = Math.round(Math.random() * 10);
            var values = topMenuChart.text().split(",");
            values.shift();
            values.push(random);
            topMenuChart.text(values.join(",")).change()
        }, 1000);
    ', \yii\web\View::POS_READY);
?>

<nav class="top-menu">
    <div class="menu-icon-container hidden-md-up">
        <div class="animate-menu-button left-menu-toggle">
            <div><!-- --></div>
        </div>
    </div>
    <div class="menu">
        <div class="menu-user-block">
            <div class="dropdown dropdown-avatar">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="avatar" href="javascript:void(0);">
                        <img src="<?=Yii::$app->user->identity->image->getUrl()?>" alt="Avatar">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="<?=\yii\helpers\Url::to(['/profile/default/index'])?>"><i class="dropdown-icon icmn-user"></i> Ваш профиль</a>
                    <div class="dropdown-divider"></div>
<!--                    <div class="dropdown-header">Home</div>-->
<!--                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> System Dashboard</a>-->
<!--                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> User Boards</a>-->
<!--                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> Issue Navigator (35 New)</a>-->
<!--                    <div class="dropdown-divider"></div>-->
                    <a class="dropdown-item" data-method="post" href="<?=\yii\helpers\Url::to(['/site/logout'])?>"><i class="dropdown-icon icmn-exit"></i> Выйти</a>
                </ul>
            </div>
        </div>
        <div class="menu-info-block">
            <div class="right hidden-md-down margin-left-20">
                <?
                    $form=\yii\widgets\ActiveForm::begin(['action'=>['/adverts/default/index'],'method'=>'get']);
                ?>
                <div class="search-block">
                    <div class="form-input-icon form-input-icon-right">
                        <i class="icmn-search"></i>
                        <?=$form->field(Yii::$app->controller->searchModel,'search')->textInput(['placeholder'=>'Поиск объекта недвижимости...', 'class'=>'form-control form-control-sm form-control-rounded'])->label(false)?>
<!--                        <input type="text" class="form-control form-control-sm form-control-rounded" placeholder="Поиск объекта недвижимости...">-->
                        <button type="submit" class="search-block-submit "></button>
                    </div>
                </div>
                <? \yii\widgets\ActiveForm::end(); ?>
            </div>
            <div class="right example-buy-btn">
                <a href="<?=\yii\helpers\Url::to(['/adverts/default/select-category'])?>" class="btn btn-success-outline btn-rounded">
                    Добавить новый объект
                </a>
            </div>
        </div>
    </div>
</nav>