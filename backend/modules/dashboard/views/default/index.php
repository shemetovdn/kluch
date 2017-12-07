<?
    use yii\widgets\ListView;

?>

<div class="dashboard-container">
    <div class="row">
        <div class="col-xl-6">
            <div class="widget widget-six">
                <div class="widget-header">
                    <strong class="margin-right-10">Последняя активность</strong>
                </div>
                <div class="widget-body">
                    <div class="">
                        <div class="nav-tabs-horizontal">
                            <ul class="nav nav-tabs" role="tablist" style="padding-left: 15px; padding-right: 15px;">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#home1" role="tab">Вся</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#home2" role="tab">Добавление</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#home3" role="tab">Удаление</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#home4" role="tab">Редактирование</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript: void(0);" data-toggle="tab" data-target="#home5" role="tab">Доступ блокирован</a>
                                </li>
                            </ul>
                            <div class="tab-content padding-vertical-20" style="padding-left: 15px; padding-right: 15px;">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <table class="table">
                                        <?
                                            echo ListView::widget([
                                                'dataProvider' => $logAll,
                                                'itemOptions' => ['tag'=>false,'class'=>''],
                                                'layout' => '
                                                        {items}
                                                ',
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_listItem',['model' => $model]);
                                                }

                                            ]);
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane" id="home2" role="tabpanel">
                                    <table class="table">
                                        <?
                                            echo ListView::widget([
                                                'dataProvider' => $logAdd,
                                                'itemOptions' => ['tag'=>false,'class'=>''],
                                                'layout' => '
                                                            {items}
                                                    ',
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_listItem',['model' => $model]);
                                                }

                                            ]);
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane" id="home3" role="tabpanel">
                                    <table class="table">
                                        <?
                                            echo ListView::widget([
                                                'dataProvider' => $logRemove,
                                                'itemOptions' => ['tag'=>false,'class'=>''],
                                                'layout' => '
                                                                {items}
                                                        ',
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_listItem',['model' => $model]);
                                                }

                                            ]);
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane" id="home4" role="tabpanel">
                                    <table class="table">
                                        <?
                                            echo ListView::widget([
                                                'dataProvider' => $logEdit,
                                                'itemOptions' => ['tag'=>false,'class'=>''],
                                                'layout' => '
                                                                    {items}
                                                            ',
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_listItem',['model' => $model]);
                                                }

                                            ]);
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane" id="home5" role="tabpanel">
                                    <table class="table">
                                        <?
                                            echo ListView::widget([
                                                'dataProvider' => $logAccess,
                                                'itemOptions' => ['tag'=>false,'class'=>''],
                                                'layout' => '
                                                                    {items}
                                                            ',
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_listItem',['model' => $model]);
                                                }

                                            ]);
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="col-xl-6 col-lg-12 col-sm-12 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Просмотров за день</h5>
                            <i class="counter-icon icmn-users"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <span class="counter-init" data-from="0" data-to="<?=$views_per_day?>"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-sm-12 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Просмотров за неделю</h5>
                            <i class="counter-icon icmn-users"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <span class="counter-init" data-from="0" data-to="<?=$views_per_week?>"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="widget widget-six">
                    <div class="widget-header">
                        <strong class="margin-right-10">Статистика просмотров</strong>
                        <div class="clearfix"></div>
                        <?
                            $colors=['donut-primary','donut-success','donut-yellow'];
                            foreach ($categories as $num=>$category){
                        ?>
                            <span class="margin-right-10 nowrap">
                                <span class="donut <?=$colors[$num]?>"></span>
                                <?=$category->title?>
                            </span>
                        <?
                            }
                        ?>
                    </div>
                    <div class="widget-body">
                        <div class="chart-line height-250 chartist"></div>
                    </div>
                </div>
            </div>
            <?

                $this->registerJs('        
                    $(\'.counter-init\').countTo({
                        speed: 1500
                    });
                    
                    new Chartist.Line(".chart-line", {
                        labels: ["'.implode('","',$chart['labels']).'"],
                        series: [
                            '.$chart['data'].'
                        ]
                    }, {
                        fullWidth: !0,
                        chartPadding: {
                            right: 40
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ]
                    });
                ')

            ?>

        </div>
    </div>
</div>
