<?
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Yii::$app->controller->module->text['module_name'];

?>


<section class="panel">
    <div class="panel-heading">
        <h3 class="pull-left"><?=$this->title?></h3>
        <?=Html::a('<i></i>'.Yii::$app->controller->module->text['add_item'], ['add'],['class'=>'btn btn-primary pull-right'])?>
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

                        echo \yii\widgets\ListView::widget(\yii\helpers\ArrayHelper::merge(Yii::$app->params['listView'],[
                            'dataProvider' => $dataProvider,
                            'layout' => $this->render('@backend/views/parts/listViewLasyout',['columns'=>'
                                <th style="width: 1%;" class="center">ID</th>
                                <th>Имя</th>
                                <th class="center" style="width: 80px;">Действие</th>
                            ']),

                        ]));

                        echo $this->render('@backend/views/parts/sorter');
                        Pjax::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
