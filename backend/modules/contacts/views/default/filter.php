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

                        
                         //$('.readajax').on('click', function(){
                         //   var el = $(this);
                         //   var href = el.attr('href')
                         //   $.get(href, {}, function(result){
                         //       el.replaceWith(result);
                         //       console.debug(result);
                         //   });
                         //   return false;
                         //});
JS
    , yii\web\View::POS_END);

?>

<? $form = \yii\widgets\ActiveForm::begin(['options' => ['class' => 'form-inline', 'id' => 'filterForm', 'method' => 'POST']]); ?>

<!-- Total products & Sort by options -->
<div class="form-inline separator bottom small" style="line-height: 30px; padding: 10px;">
    <div class="clearfix"></div>
</div>
<!-- // Total products & Sort by options END -->

<? \yii\widgets\ActiveForm::end(); ?>