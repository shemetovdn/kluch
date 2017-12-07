<?
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title='Module Creator';

$this->params['breadcrumbs'][] = ['label' => 'Modules', 'url' => ['/moduleCreator/default/index']];
$this->params['breadcrumbs'][] = $this->title;

$urlTreeAjax = \yii\helpers\Url::to(['get-tree']);
$this->registerJs(<<<JS
    $(".show_file_system[data-id]").parent("strong").unbind("click").on("click",function(e) {
        var el = $(this).find(".show_file_system[data-id]");
        var id = el.data("id");
        var title = el.data("title");
        getFilesTree(id,title);
        e.preventDefault;
        return false;
    });

    function getFilesTree(id,title){
        $.post("$urlTreeAjax",{id:id},function(data){
            bootbox.dialog({
                message: data,
                title: "File tree of <strong style=\"text-decoration:underline\">"+title+"</strong>",
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-success",
                    },
                }
            });
        });
    }
JS
    , yii\web\View::POS_END);

$this->registerJs(<<<JS
                        var focus;
                        function filterForm(focus){
                            var data=$('#filterForm').serializeArray();

                           $.pjax({
                                url: $('#filterForm').attr('action'),
                                container: '#listView',
                                data: data,
                                push: false
                           });
                        }
                        $(document).on('change', '#filterForm input, #filterForm select', function(e) {
                            filterForm();
                        });
                        $(document).on('keyup', "#filterForm input[name='SearchModel[search]']", function(e) {
                            focus=$(this);
                            filterForm();
                        });
                         $('#listView').on('pjax:success', function(event, data, status, xhr, options) {
                            focus.focus();
                         });

JS
    , yii\web\View::POS_END);


$urlToSortAjax = \yii\helpers\Url::to(['new-sort']);
    $this->registerJs(<<<JS
            function relocateSuccessFunction(){
                var hierarchy = $('.sortable.nested_widget_class').nestedSortable('toHierarchy');
                $.post("$urlToSortAjax",{new_sort:hierarchy},function(data){
                    alert(data);
                });
            }
JS
        ,yii\web\View::POS_END);
?>
    <div class="heading-buttons">
        <h3><?=$this->title?><span> | Manage</span></h3>

        <div class="buttons pull-right">
            <?=Html::a('<i></i>Add new module', ['add'],['class'=>'btn btn-primary btn-icon glyphicons circle_plus '])?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="separator bottom"></div>
    <?=\wbp\yii2NestedSortable\NestedSortable::widget(['insideItems'=>$menuList]);?>
    <div class="separator bottom"></div>
    <!-- Widget -->
    <div class="innerLR">

        <div class="widget">

            <div class="widget-head">
                <h4 class="heading glyphicons list"><i></i> Manage modules</h4>
            </div>

            <div class="widget-body" style="padding: 0;">


                <? $form=\yii\widgets\ActiveForm::begin(['options'=>['class'=>'form-inline', 'id'=>'filterForm', 'method'=>'POST']]); ?>
                <div class="form-inline separator bottom small" style="line-height: 30px; padding: 10px;">
                    Total modules: <?=$dataProvider->getTotalCount()?>

                    <div class="clearfix"></div>
                </div>
                <!-- // Total products & Sort by options END -->

                <div class="filter-bar ">
                    <div style="height: 10px; clear: both;"></div>

                    <!-- Search -->
                    <?=$form
                        ->field($searchModel,'search',['options'=>['class'=>'form-group col-md-3 padding-none']])
                        ->textInput([
                            'options'=>[
                                'class'=>'form-control1',
                            ]
                        ])
                    ?>
                    <!-- // Search END -->


                    <div class="clearfix"></div>
                </div>

                <? \yii\widgets\ActiveForm::end();?>
                <div style="padding: 10px;">


                    <?
                    Pjax::begin(['id' => 'listView', 'options'=>['class' => 'pjax-container']]);



                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '<div class="summary small separator bottom">Showing {begin}-{end}</div>',
                        'itemOptions' => ['tag'=>'tr','class'=>'selectable'],
                        'pager'=> [
                            'class'=>\yii\widgets\LinkPager::className(),
                            'options'=>[
                                'class'=>'pagination pagination-right margin-none pull-right'
                            ]
                        ],
                        'layout' => '
                                    {summary}
                                    <table id="sortable" class="table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable ui-sortable">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%;" class="center">ID</th>
                                                <th>Title</th>
                                                <th>Placed In</th>
                                                <th>Available permissions</th>
                                                <th>Status</th>
                                                <th class="center" style="width: 80px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {items}
                                        </tbody>
                                    </table>
                                    <div class="separator top form-inline small">
                                        {pager}
                                    </div>
                                    ',
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_listItem',['model' => $model,'widget'=>$widget]);
                        }

                    ]);
                    if(\Yii::$app->controller->sortEnable()) {

                        \yii\jui\Sortable::widget([
                            'options' => ['id' => 'sortable tbody'],
                            'clientOptions' => ['cursor' => 'move', 'items' => ' > tr'],
                            'clientEvents' => [
                                'update' => "function(event, ui){
                                        $.post(
                                            '" . \yii\helpers\Url::to(['sort']) . "',
                                            {elements:$(this).sortable('toArray',{attribute:'data-key'})}
                                        );
                                      }"
                            ]
                        ]);
                    }
                    Pjax::end();
                    ?>

                    <div class="clearfix"></div>



                </div>


            </div>

        </div>

    </div>
