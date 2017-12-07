<?
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('admin', 'Pages');

?>

<section class="panel">
    <div class="panel-heading">
        <h3 class="pull-left"><?=$this->title?></h3>
        <?=Html::a('<i></i>'.Yii::t('admin', 'Add New Page'), ['add'],['class'=>'btn btn-primary pull-right'])?>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">

                    <?$this->render('filter',['searchModel'=>$searchModel])?>

                    <div class="dataTables_wrapper form-inline dt-bootstrap4">
                        <?
                        Pjax::begin(['id' => 'listView', 'options'=>['class' => 'pjax-container']]);

                        $w_conf = \yii\helpers\ArrayHelper::merge(Yii::$app->params['listView'],[
                            'dataProvider' => $dataProvider,
                            'layout' => $this->render('@backend/views/parts/listViewLasyout',['columns'=>'
                                <th style="width: 1%;" class="center">ID</th>
                                <th>' . Yii::t('admin', 'Title') . '</th>
                                <th>' . Yii::t('admin', 'Href') . '</th>
                                <!--th>Language</th-->
                                <th class="center" style="width: 80px;">' . Yii::t('admin', 'Actions') . '</th>
                            ']),
                        ]);

                        if ($widgetName == '\wbp\widgets\RelativeListView') $w_conf['relationParameter'] = 'parent_page';
                        echo $widgetName::widget($w_conf);

                        echo $this->render('@backend/views/parts/sorter');
                        Pjax::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- // Widget END -->




