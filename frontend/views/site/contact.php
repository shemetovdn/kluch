<?php
    use frontend\assets\ImageAsset;
    use common\models\Config;
    use yii\helpers\Url;

    $bundle = ImageAsset::register($this);

    $phones_array = [];
    $phones_array[] = Config::getParameter('phone');
    $phones_array[] = Config::getParameter('phone_2');
    $phones = implode(', ', $phones_array);
$address = Config::getParameter('address');
$this->registerJs("
        function initMap() {
            var myLatLng = {lat: ".Config::getParameter('lat').", lng: ".Config::getParameter('lng')."};

            var map = new google.maps.Map(document.getElementById('googleMap'), {
              center: myLatLng,
              zoom: 17,
              panControl: false,
              zoomControl: false,
              mapTypeControl: false,
              scaleControl: true,
              streetViewControl: false,
              overviewMapControl: true,
              rotateControl: true
            });

            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              icon: '".$bundle->baseUrl."/images/svg-png/map-marker.png'
            });

            google.maps.event.addDomListener(window, \"resize\", initMap);
          }
    ", yii\web\View::POS_HEAD);

    $this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc&language=ru&region=RU&callback=initMap');

?>

<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<section>
    <div class="custom-page contact-page">

        <div class="container">
            <div class="row">

                <div class="filters-block">

                    <div id="filtersCall" class="filtersCall closed hidden-md hidden-lg">
                        <span class="filter-logo"><img src="<?=$bundle->baseUrl?>/images/svg-png/search-blue.png" alt=""></span>
                        Искать недвижимость
                        <span class="filter-caret"><img src="<?=$bundle->baseUrl?>/images/svg-png/arrowdown.png" alt=""></span>
                    </div>

                    <div class="filter-wrapper">

                        <?= \frontend\widgets\otherFilterWidget\OtherFilterWidget::widget()?>
                    </div>
                </div>


                <div class="hidden-xs col-sm-12 breadcrumbs">
                    <a href="<?=Url::to(['site/index'])?>">Главная</a> — <span>Контакты</span>
                </div>

                <div class="col-xs-12 page-name">
                    Контакты
                </div>



            </div>
            <div class="contacts-info-block">
                <div class="border-separator hidden-xs"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-img"><img src="<?=$bundle->baseUrl?>/images/svg-png/phone.svg" alt=""></div>
                                <div class="contact-item-title">Телефон</div>
                            </div>
                            <div class="value">
                                <a><?=$phones?></a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-img"><img src="<?=$bundle->baseUrl?>/images/svg-png/viber.svg" alt=""></div>
                                <div class="contact-item-title">Viber</div>
                            </div>
                            <div class="value">
                                <a href="viber:<?=Config::getParameter('viber')?>">
                                    <?=Config::getParameter('viber')?>
                                </a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-img"><img src="<?=$bundle->baseUrl?>/images/svg-png/address.svg" alt=""></div>
                                <div class="contact-item-title">Адрес</div>
                            </div>
                            <div class="value">
                                <span>
                                    <?=Config::getParameter('address')?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-img"><img src="<?=$bundle->baseUrl?>/images/svg-png/skype.svg" alt=""></div>
                                <div class="contact-item-title">Skype</div>
                            </div>
                            <div class="value">
                                <a href="skype:<?=Config::getParameter('skype')?>?chat">
                                    <?=Config::getParameter('skype')?>
                                </a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-img"><img src="<?=$bundle->baseUrl?>/images/svg-png/mail.svg" alt=""></div>
                                <div class="contact-item-title">E-mail</div>
                            </div>
                            <div class="value">
                                <a href="mailto:<?=Config::getParameter('email')?>">
                                    <?=Config::getParameter('email')?>
                                </a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="title">
                                <div class="contact-item-title">Соцсети</div>
                            </div>
                            <div class="value social-val">
                                <a class="contact-social-img" href="<?=Config::getParameter('facebook')?>" target="_blank">
                                    <img class="optimizer" src="<?=$bundle->baseUrl?>/images/svg-png/soc-fb.png" alt="">
                                </a>
                                <a class="contact-social-img" href="<?=Config::getParameter('vk')?>" target="_blank">
                                    <img class="optimizer" src="<?=$bundle->baseUrl?>/images/svg-png/soc-vk.png" alt="">
                                </a>
                                <a class="contact-social-img" href="<?=Config::getParameter('instagram')?>" target="_blank">
                                    <img class="optimizer" src="<?=$bundle->baseUrl?>/images/svg-png/soc-in.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="contacts-find-us">
                        <div class="operating-mode">
                            <div class="operating-mode-title">
                                Режим работы
                            </div>
                            <div class="operating-mode-data">
                                <div>
                                    <?=Config::getParameter('work_time')?>
                                </div>
                            </div>
                        </div>
                        <div class="how-to-get-there">
                            <div class="get-there-title">
                                Как добраться
                            </div>
                            <div class="get-there-data">
                                <?=Config::getParameter('how_to_get_there')?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="catalog-item-map">
                        <div class=googleMap" id="googleMap"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 hidden-xs">
                    <div class="contact-us">
                        <div class="contact-us-title">
                            Связаться с нами
                        </div>

                        <? $form = \yii\bootstrap\ActiveForm::begin(); ?>
                        <?= $form->field($contact, 'type')->hiddenInput(['value'=>'0'])->label(false)?>

                        <?= $form->field($contact, 'fname')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>
                        <?= $form->field($contact, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
                        <?= $form->field($contact, 'email')->textInput(['placeholder' => 'E-mail'])->label(false)?>
                        <?= $form->field($contact, 'message')->textarea(['placeholder' => 'Сообщение'])->label(false)?>
                        <?=\yii\helpers\Html::button('Отправить', ['class'=>'button--isi button btn-radius', 'type'=>'submit'])?>

                        <? \yii\bootstrap\ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="contacts-office-photo">
                        <img src="<?=$model->image->getUrl()?>" alt="">
                    </div>
                </div>
                <div class="col-sm-6 visible-xs">
                    <div class="contact-us">
                        <div class="contact-us-title">
                            Связаться с нами
                        </div>

                        <? $form = \yii\bootstrap\ActiveForm::begin(); ?>
                        <?= $form->field($contact, 'type')->hiddenInput(['value'=>'0'])->label(false)?>

                        <?= $form->field($contact, 'fname')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>
                        <?= $form->field($contact, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
                        <?= $form->field($contact, 'email')->textInput(['placeholder' => 'E-mail'])->label(false)?>
                        <?= $form->field($contact, 'message')->textarea(['placeholder' => 'Сообщение'])->label(false)?>
                        <?=\yii\helpers\Html::button('Отправить', ['class'=>'button--isi button btn-radius', 'type'=>'submit'])?>

                        <? \yii\bootstrap\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>








<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    <div class="contacts-col-left">-->
<!---->
<!--                        <div class="contacts-find-us">-->
<!--                            <div class="operating-mode">-->
<!--                                <div class="operating-mode-title">-->
<!--                                    Режим работы-->
<!--                                </div>-->
<!--                                <div class="operating-mode-data">-->
<!--                                    <div>-->
<!--                                        --><?//=Config::getParameter('work_time')?>
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="how-to-get-there">-->
<!--                                <div class="get-there-title">-->
<!--                                    Как добраться-->
<!--                                </div>-->
<!--                                <div class="get-there-data">-->
<!--                                    --><?//=Config::getParameter('how_to_get_there')?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="contact-us">-->
<!--                            <div class="contact-us-title">-->
<!--                                Связаться с нами-->
<!--                            </div>-->
<!---->
<!--                            --><?// $form = \yii\bootstrap\ActiveForm::begin(); ?>
<!--                                --><?//= $form->field($contact, 'type')->hiddenInput(['value'=>'0'])->label(false)?>
<!---->
<!--                                --><?//= $form->field($contact, 'fname')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>
<!--                                --><?//= $form->field($contact, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
<!--                                --><?//= $form->field($contact, 'email')->textInput(['placeholder' => 'E-mail'])->label(false)?>
<!--                                --><?//= $form->field($contact, 'message')->textarea(['placeholder' => 'Сообщение'])->label(false)?>
<!--                                --><?//=\yii\helpers\Html::button('Отправить', ['class'=>'button--isi button btn-radius', 'type'=>'submit'])?>
<!---->
<!--                            --><?// \yii\bootstrap\ActiveForm::end(); ?>
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    <div class="contacts-col-right">-->
<!---->
<!--                        <div class="catalog-item-map">-->
<!--                            <div class=googleMap" id="googleMap"></div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="contacts-office-photo">-->
<!--                            <img src="--><?//=$bundle->baseUrl?><!--/images/contacts/office.png" alt="">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

        </div>
    </div>

</section>



