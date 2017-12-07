<?

$this->registerJs(<<<JS
                        var focus;
                        function filterForm(){
                            var filter = $('#filterForm');
                            var data=filter.serializeArray();

                           $.pjax({
                                url: filter.attr('action'),
                                container: '#listView',
                                data: data,
                                push: false
                           });
                        }
                        $(document).on('change', '#filterForm input, #filterForm select', function() {
                            filterForm();
                        });
                        $(document).on('keyup', "#filterForm input[name='SearchModel[search]']", function() {
                            focus=$(this);
                            filterForm();
                        });
                         $('#listView').on('pjax:success', function() {
                            focus.focus();
                         });

JS
    , yii\web\View::POS_END);

?>
