<?

$this->registerJs("
    (function() {
        var formWrap = document.getElementById( 'fs-form-wrap' );

        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
            new SelectFx( el, {
                stickyPlaceholder: false,
                onChange: function(val){
                    document.querySelector('span.cs-placeholder').style.backgroundColor = val;
                }
            });
        } );

        new FForm( formWrap, {
            onReview : function() {
                classie.add( document.body, 'overview' ); // for demo purposes only
            }
        } );
    })();
    ", yii\web\View::POS_READY);

?>

<div class="full-screen-form-body">
    <div class="order-form-container">

        <div class="fs-form-wrap" id="fs-form-wrap">

            <? $form = \yii\bootstrap\ActiveForm::begin([
                'id' => 'myform',
                'action'=>['site/order'],
                'options' => ['class' => 'fs-form fs-form-full', 'autocomplete'=>'off']
            ]); ?>

                <?
                    if(isset($_SERVER['HTTP_REFERER'])) {
                        $return = $_SERVER['HTTP_REFERER'];
                    }else $return = '/';
                ?>

                <?= $form->field($model, 'return')->hiddenInput(['value'=>$return])->label(false);?>

                <ol class="fs-fields">
                    <li>
                        <input name="Orders[event_id]" id="q0" type="hidden" />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q1">КАК ВАС ЗОВУТ?</label>
                        <input name="Orders[fname]" class="fs-anim-lower" id="q1" type="text" placeholder="Петр Петрович" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q2" data-info="Мы не будем спамить, обещаем">ВАШ EMAIL</label>
                        <input name="Orders[email]" class="fs-anim-lower" id="q2" type="email" placeholder="dean@road.us" required/>
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q3" >ОТКУДА О НАС УЗНАЛИ?</label>
                        <input name="Orders[source]" class="fs-anim-lower" id="q3" type="text" placeholder="Интернет" required />
                    </li>
                    <li>
                        <label class="fs-field-label fs-anim-upper" for="q4">ВАШ ВОЗРАСТ</label>
                        <input name="Orders[age]" class="fs-anim-lower" id="q4" type="number" placeholder="18" step="1" min="0" max="120" />
                    </li>
                </ol>
                <?= \yii\helpers\Html::button('Отправить', ['class' => 'fs-submit', 'type'=>'submit']) ?>

            <? \yii\bootstrap\ActiveForm::end(); ?>

        </div><!-- /fs-form-wrap -->
    </div>
</div>