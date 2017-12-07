<?php
use yii\helpers\Url;
use yii\widgets\ListView;

$bundle = \frontend\assets\ImageAsset::register($this);

?>

<?=$this->render('map', ['totaladverts'=>$totaladverts])?>

<section>
    <div class="main-banner" style=" background-size: cover;">
        <style>
            .main-banner{
                background-image: url('<?=$bundle->baseUrl?>/images/main/main-banner.png');
            }
        </style>
        <div class="container">
            <div class="row">
                <?= \frontend\widgets\mainFilterWidget\MainFilterWidget::widget()?>
                <style>
                    .main-banner form li.search-now{
                        display: none;
                    }

                </style>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="exclusive-sale">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 section-name">
                    Эксклюзивная продажа
                </div>

                <div class="col-xs-12 my-carousel-col">

                        <?=$this->render('index-exclusive',['exclusive'=>$exclusive])?>

                </div>

                <div class="col-xs-12">
                    <a href="<?php echo Url::to(['/catalog/kupit/exclusive'])?>" class="view-more">
                        Смотреть больше
                        <svg version="1.1" x="0px" y="0px" viewBox="0 0 14.2 22.7">
                            <g>
                                <polygon  points="13.2,11.3 12.2,10.3 12.2,10.3 2.2,0.1 1.2,1.2 11.2,11.3 1.2,21.5 2.2,22.5 12.2,12.4 12.2,12.4 13.2,11.413.2,11.3 		"/>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="new-options">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 section-name">
                    Новые варианты
                </div>

                <div class="col-xs-12 my-carousel-col">
                        <?=$this->render('index-last-add',['last_add'=>$last_add])?>
                </div>

                <div class="col-xs-12">
                    <a href="<?php echo Url::to(['catalog'])?>" class="view-more">
                        Смотреть больше
                        <svg version="1.1" x="0px" y="0px" viewBox="0 0 14.2 22.7">
                            <g>
                                <polygon  points="13.2,11.3 12.2,10.3 12.2,10.3 2.2,0.1 1.2,1.2 11.2,11.3 1.2,21.5 2.2,22.5 12.2,12.4 12.2,12.4 13.2,11.413.2,11.3 		"/>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="main-news-questions">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 main-news">
                    <div class="row">
                        <div class="col-xs-12 section-name">
                            Новости Крыма и Феодосии
                        </div>

                        <div class="col-xs-12 my-carousel-col">
                                <?=$this->render('index-news',['news'=>$news])?>
                        </div>

                        <div class="col-xs-12">
                            <a href="<?php echo Url::to(['news'])?>" class="view-more">
                                Смотреть больше
                                <svg version="1.1" x="0px" y="0px" viewBox="0 0 14.2 22.7">
                                    <g>
                                        <polygon  points="13.2,11.3 12.2,10.3 12.2,10.3 2.2,0.1 1.2,1.2 11.2,11.3 1.2,21.5 2.2,22.5 12.2,12.4 12.2,12.4 13.2,11.413.2,11.3 		"/>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 main-questions">
                    <div class="any-question">
                        <div class="section-name">
                            Возникли вопросы?
                        </div>
                        <ul>
                            <li>
                                <div class="contact-img">
                                    <img src="<?=$bundle->baseUrl?>/images/svg-png/phone.svg" alt="">
                                </div>
                                <div class="contact-item"><?=\common\models\Config::getParameter('phone')?></div>
                                <div class="bottom-border visible-xs"></div>
                            </li>
                            <li>
                                <div class="contact-img">
                                    <img src="<?=$bundle->baseUrl?>/images/svg-png/viber.svg" alt="">
                                </div>
                                <div class="contact-item"><?=\common\models\Config::getParameter('phone_2')?></div>
                                <div class="bottom-border visible-xs"></div>

                            </li>
                            <li>
                                <div class="contact-img">
                                    <img src="<?=$bundle->baseUrl?>/images/svg-png/skype.svg" alt="">
                                </div>
                                <div class="contact-item"><?=\common\models\Config::getParameter('skype')?></div>
                                <div class="bottom-border visible-xs"></div>

                            </li>
                            <li>
                                <div class="contact-img">
                                    <img src="<?=$bundle->baseUrl?>/images/svg-png/mail.svg" alt="">
                                </div>
                                <div class="contact-item"><?=\common\models\Config::getParameter('email')?></div>
                                <div class="bottom-border visible-xs"></div>

                            </li>
                            <li>
                                <div class="contact-img">
                                    <img src="<?=$bundle->baseUrl?>/images/svg-png/address.svg" alt="">
                                </div>
                                <div class="contact-item"><?=\common\models\Config::getParameter('address')?></div>

                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="sub-news-separator"></div>
                </div>

                <div class="col-xs-12 rewards-list">
                    <?
                        echo ListView::widget([
                                'dataProvider'=>$revards,
                                'itemView'=>'_revards_item',
                                'summary' => false,
                                'options' => [
                                        'tag'=>'ul',
                                ],
                                'itemOptions'=>[
                                        'tag'=>'li',
                                ]
                        ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>

<?
    echo ListView::widget([
        'dataProvider'=>$revards,
        'itemView'=>'_revards_item_popup',
        'summary' => false,
    ]);
?>
