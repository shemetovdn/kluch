
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

<? $form = \yii\widgets\ActiveForm::begin(['action'=>['/adverts/default/index'],'options' => ['class' => 'form-inline', 'id' => 'filterForm', 'method' => 'POST']]); ?>

<div class="row">
    <div class="col-md-6">
        <div class="dataTables_length" id="example1_length">
            <label>
                Показанно <?=$form->field($searchModel,'per_page',['options'=>['class'=>'','style'=>'display:inline-block;']])->dropDownList(\backend\modules\adverts\models\SearchModel::$pageSizeList,['placeholder'=>'', 'class'=>'form-control input-sm', 'style'=>'width:65px;'])->label(false)?> <?=$searchModel->per_page==-1?'записи':'записей'?>
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="dataTables_filter">
            <label class="pull-right">Поиск: <?=$form->field($searchModel,'search')->textInput(['placeholder'=>'', 'class'=>'form-control input-sm'])->label(false)?></label>
        </div>
    </div>
</div>

<? \yii\widgets\ActiveForm::end(); ?>