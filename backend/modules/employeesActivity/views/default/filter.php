<?

use backend\models\UserLog;

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
                            //focus.focus();
                         });

JS
    , yii\web\View::POS_END);

?>

<? $form=\yii\widgets\ActiveForm::begin(['options'=>['class'=>'form-inline', 'id'=>'filterForm', 'method'=>'POST']]); ?>

    <!-- Total products & Sort by options -->
    <div class="form-inline separator bottom small" style="line-height: 30px; padding: 10px;">
        <span class="pull-right">
                    <? $form
                        ->field($searchModel,'order')
                        ->dropDownList(
                            [
                                'id desc'=>'ID DESC',
                                'id'=>'ID',
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

    <div class="filter-bar " style="padding: 0 20px;">
        <div style="height: 10px; clear: both;"></div>
        <div class="row">

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

            <!-- From -->
            <?=$form
                ->field($searchModel,'from',['options'=>['class'=>'form-group col-md-3 padding-none']])
                ->widget(\wbp\widgets\DatePicker::classname(), [
                    'dateFormat' => 'dd/MM/yyyy',
                    'options'=>[
                        'class'=>'form-control',
                        'id'=>'dateRangeFrom'
                    ]
                ])
            ?>
            <!-- // From END -->

            <!-- To -->
            <?=$form
                ->field($searchModel,'to',['options'=>['class'=>'form-group col-md-3 padding-none']])
                ->widget(\wbp\widgets\DatePicker::classname(), [
                    'dateFormat' => 'dd/MM/yyyy',
                    'options'=>[
                        'class'=>'form-control',
                        'id'=>'dateRangeTo'
                    ]
                ])
            ?>
            <!-- // To END -->

            <div class="clearfix"></div>
        </div>
        <div class="row">
            <?=$form
                ->field($searchModel,'additional_options',['options'=>['class'=>'form-group col-md-3 padding-none']])
                ->dropDownList(
                    [
                        ''=>'All',
                        UserLog::SAVED=>'Edit',
                        UserLog::ADDED=>'Add',
                        UserLog::REMOVED=>'Remove',
                        UserLog::ACCESS_DENIED=>'Access Denied'
                    ],
                    [
                        'class'=>'form-control',
                    ])
                ->label(NULL, [
                    'options'=>[
                        'class'=>'strong'
                    ]
                ]);
            ?>

            <?=$form
                ->field($searchModel,'user_id',['options'=>['class'=>'form-group col-md-4 padding-none']])
                ->dropDownList(
                    \yii\helpers\ArrayHelper::merge([''=>'All'],$userList),
                    [
                        'class'=>'form-control',
                    ])
                ->label(NULL, [
                    'options'=>[
                        'class'=>'strong'
                    ]
                ]);
            ?>
        </div>

    </div>
<? \yii\widgets\ActiveForm::end();?>