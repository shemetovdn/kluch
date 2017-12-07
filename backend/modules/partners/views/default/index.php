<?
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title='Партнёры';

$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
    '
    $( "#sortable tbody" ).sortable({
            stop:  function (event, ui) 
            {
            var currPos2 = ui.item.index();
            var paramers = $("#sortable tbody tr");    
            var ids = [];
                
                for (var i = 0; i < paramers.length; i++){
                                   
                              ids.push($(paramers[i]).attr("data-key"));
                }            
//                $.ajax({
//                
//                    url:"/sort-partners",
//                    type:"POST",
//                    data: "ids ="+ids,
//                    success: function(data){
//                    }
//                });

        }
    });
    $( "#sortable  tbody" ).disableSelection();

', yii\web\View::POS_READY);
?>
<style>

    #sortable tbody tr{
        cursor: move;
    }
</style>

<section class="panel">
    <div class="panel-heading">
        <h3 class="pull-left"><?=$this->title?></h3>
        <?=Html::a('<i></i>'.Yii::t('admin','Add new article'), ['add'],['class'=>'btn btn-primary pull-right'])?>
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
                                <th>'.Yii::t('admin','Image').'</th>
                                <th>'.Yii::t('admin','Name').'</th>
                                <th>Должность</th>
                                <th>Телефон</th>
                                <th>E-mail</th>
                                <th class="center" style="width: 80px;">'.Yii::t('admin','Actions').'</th>
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