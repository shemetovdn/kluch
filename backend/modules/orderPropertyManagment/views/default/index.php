<?
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var $this \yii\web\View */

$this->title = 'Заказать управление';

?>
<section class="panel">
    <div class="panel-heading">
        <h3 class="pull-left"><?=$this->title?></h3>
        <div class="buttons pull-right">
            <a class="btn btn-info "
               data-pjax="0"><i class="icmn-eye"></i> <?= Yii::t('admin', 'Red') ?></a><span></span>
            <a class="btn btn-info"
               data-pjax="0"><i class="icmn-eye-blocked"></i> <?= Yii::t('admin', 'Unread') ?></a><span></span>
            <a class="btn btn-success"
               data-pjax="0"><i class="icmn-pencil"></i> <?= Yii::t('admin', 'Edit') ?></a><span></span>
            <a class="btn btn-danger"
               data-pjax="0"><i class="icmn-bin"></i> <?= Yii::t('admin', 'Remove') ?></a><span></span>
        </div>
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
                                <th class="center">' . Yii::t('admin', 'Name') .  '</th>
                                <th class="center">' . Yii::t('admin', 'Email') . '</th>
                                <th class="center">' . Yii::t('admin', 'Date') .  '</th>
                                <th class="center" style="width: 15%;">' . Yii::t('admin', 'Actions').'</th>
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
