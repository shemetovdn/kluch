<?
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title='Mail templates';

    $this->params['breadcrumbs'][] = ['label' => 'Mail Templates', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="heading-buttons">
    <h3><?=$this->title?><span> | Manage</span></h3>

    <div class="buttons pull-right">
        <?=Html::a('<i></i>Add new template', ['add'],['class'=>'btn btn-primary btn-icon glyphicons circle_plus '])?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>
<!-- Widget -->
<div class="innerLR">

    <div class="widget">

        <div class="widget-head">
            <h4 class="heading glyphicons list"><i></i> Manage mail templates</h4>
        </div>

        <div class="widget-body" style="padding: 0;">
            <?

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
                            //focus=$();
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

            ?>

            <? $form=\yii\widgets\ActiveForm::begin(['options'=>['class'=>'form-inline', 'id'=>'filterForm', 'method'=>'POST']]); ?>

            <!-- Total products & Sort by options -->
            <div class="form-inline separator bottom small" style="line-height: 30px; padding: 10px;">
                Total mail templates: <?=$dataProvider->getTotalCount()?>
                <span class="pull-right">
                    <?=$form
                        ->field($searchModel,'order')
                        ->dropDownList(
                            [
                                'name'=>'ID',
                                'name desc'=>'ID DESC',
                            ],
                            [
                                'class'=>'selectpicker',
                                'data-style'=>'btn-default btn-small'
                            ])
                        ->label(NULL, [
                            'options'=>[
                                'class'=>'strong'
                            ]
                        ]);
                    ?>
                </span>
                <div class="clearfix"></div>
            </div>
            <!-- // Total products & Sort by options END -->

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
                                                <th class="center">Title</th>
                                                <th class="center">Type</th>
                                                <th class="center">Store</th>
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
<!-- // Widget END -->





