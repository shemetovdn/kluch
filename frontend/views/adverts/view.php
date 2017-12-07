<?php
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
$bundle = AppAsset::register($this);
//$this->registerCssFile($bundle->baseUrl.'/print.css', ['media' => 'print']);
$this->title = $model->title;
$month =array(
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря',
);
?>
<?php
$area = $model->getParametr(13);
if($model->object_type_id == 4 || $model->object_type_id == 5){
    $area = $model->getParametr(21);
}elseif($model->object_type_id == 6){
    $area = $model->getParametr(19);
}else{

}
?>
<?php
$title ="";
$subtitle = "";
$category = \backend\modules\categories\models\Category::findOne($model->category_id);
$object = \backend\modules\objectTypes\models\ObjectTypes::findOne($model->object_type_id);
if(!empty($category)){
    $price_suf = "";
    if($category->id == 1){

        $title .= "Продажа ";
        $subtitle = "Продажа недвижимости";
    }elseif($category->id == 2){
        $price_suf = "/мес";
        $title .= "Долгосрочная аренда ";
        $subtitle = "Долгосрочная аренда";
    }elseif($category->id == 3) {
        $price_suf = "/сутки";
        $title .= "Краткосрочная аренда ";
        $subtitle = "Краткосрочная аренда";
    }

}
if(!empty($object)) {

    if ($object->id == 1) {
        $title .= "квартир";
    } elseif ($object->id == 2) {
        $title .= "квартир в новострое";
    } elseif ($object->id == 3) {
        $title .= "Домов";
    } elseif ($object->id == 4) {
        $title .= "Земельных участков ";
    } elseif ($object->id == 5) {
        $title .= "Дач";
    } elseif ($object->id == 6) {
        $title .= "Гаражей ";
    } elseif ($object->id == 7) {
        $title .= "Комерческой недвижимости";
    } elseif ($object->id == 8) {
        $title .= "Гостиниц ";
    } elseif ($object->id == 9) {
        $title .= "Зарубежной недвижимости";
    }
}?>



<?php
    $this->registerJs("
        $(\".owl-carousel\").owlCarousel({
            items: 1,
        });
          // 1) ASSIGN EACH 'DOT' A NUMBER
        dotcount = 1;

        jQuery('.owl-dot').each(function() {
            jQuery( this ).addClass( 'dotnumber' + dotcount);
            jQuery( this ).attr('data-info', dotcount);
            dotcount=dotcount+1;
        });

        // 2) ASSIGN EACH 'SLIDE' A NUMBER
        slidecount = 1;

        jQuery('.owl-item').not('.cloned').each(function() {
            jQuery( this ).addClass( 'slidenumber' + slidecount);
            slidecount=slidecount+1;
        });

        // SYNC THE SLIDE NUMBER IMG TO ITS DOT COUNTERPART (E.G SLIDE 1 IMG TO DOT 1 BACKGROUND-IMAGE)
        jQuery('.owl-dot').each(function() {

            grab = jQuery(this).data('info');

            slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
            console.log(slidegrab);

            jQuery(this).css(\"background-image\", \"url(\"+slidegrab+\")\");

        });

        // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
        // TO MAKE IT ALL NEAT
        amount = jQuery('.owl-dot').length;
        gotowidth = 100/amount;

        jQuery('.owl-dot').css(\"width\", gotowidth+\"%\");
        newwidth = jQuery('.owl-dot').width();
        jQuery('.owl-dot').css(\"height\", newwidth+\"px\");
    ", yii\web\View::POS_END);
?>

<?php
    $this->registerJs("
        function initMap() {
            var myLatLng = {lat: ".$model->lat.", lng: ".$model->lng."};
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
            google.maps.event.addDomListener(window, \"resize\", initialize);
        }
                     // Google Maps loading
                     var script = document.createElement('script');
                     script.type = 'text/javascript';
                     script.async = true;
                     script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc&language=ru&region=RU&sensor=false&callback=initMap';
                     document.body.appendChild(script);    
    ", yii\web\View::POS_END);

$model->views = $model->views+1;
$model->save();
?>
<style>
    .owl-carousel video{
        width: 100%;
    }

    .owl-carouse div {width: 100%;}

    /*SEE END OF THUMBNAIL FUCNTION TO TINKER SIZE OF THUMBS*/
    .owl-carousel .owl-controls .owl-dot {float: left; background-size: cover; margin-top: 10px;}
    .owl-carousel .owl-dot {float: left; background-size: cover;}

</style>


<?= \wbp\PrettyAlert\Alert::widget(["autoSearchInSession" => true]);?>

<section>
    <div class="custom-page catalog-item">

        <div class="container">
            <div class="row">

                <div class="filters-block">

                    <div id="filtersCall" class="filtersCall closed hidden-md hidden-lg">
                        <span class="filter-logo"><img src="<?=$bundle->baseUrl?>/images/svg-png/search-blue.png" alt=""></span>
                        Искать недвижимость
                        <span class="filter-caret">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/arrowdown.png" alt="">
                        </span>
                    </div>

                    <div class="filter-wrapper">

                        <?= \frontend\widgets\otherFilterWidget\OtherFilterWidget::widget([
                                "model" => $model,
                        ])?>
                    </div>
                </div>

                <div class="hidden-xs col-sm-12 breadcrumbs">
                    <a href="<?php echo Url::to(['site/index']);?>">Главная</a>
                    —
                    <a href="<?php echo Url::to(['catalog/'.$category->href]);?>">
                        <?php echo $subtitle;?>
                    </a>
                    —
                    <a href="<?php echo Url::to(['catalog/'.$category->href.'/'.$object->href]);?>">
                        <span>
                            <?php echo $title;?>
                        </span>
                    </a>
                </div>

            </div>


<!-- MY-->
            <div class="dv-card-new" id="print">
                <div class="page-name">
                    <?php echo $model->title?>
                    <?php if($model->reserve == 1){?>
                        <div class="reserved">
                            <div class="strip">
                                Зарезервировано
                            </div>
                        </div>
                    <?php }?>
                </div>

                <div class="row">
                    <div class="col-xs-12">

                        <div class="was-added">
                            <div class="added">
                                Добавлена: <?php echo date('j', strtotime($model->date));?> <?php echo $month[ date('n', strtotime($model->date)) - 1];?> <?php echo date('Y', strtotime($model->date));?>
                            </div>

                            <div class="added">
                                Просмотров: <?php echo $model->views;?>
                            </div>

                            <div class="this-item-id">
                                ID: <?php echo $model->id;?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="catalog-item-left hidden-xs">
                            <div class="catalog-item-price-info">
                                <div class="price-info">
                                    <div class="drop-unit-container">
                                        <span class="unit-selected"><?php echo number_format($model->price, 0, '', ' ');?> ₽<?php echo $price_suf?></span>
                                        <button class="choice-unit-drop closed">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </button>
                                        <div class="unit-list list-items">
                                            <div class="top-border"></div>
                                            <?php if($model->month_price){?>
                                                <div class="unit-item dollar">
                                                <?php echo number_format($model->month_price, 0, '', ' ');?>  ₽/мес
                                                </div><?php }?>
                                            <?php if($model->price_per_meter){?>
                                                <div class="unit-item dollar">
                                                <?php echo number_format($model->price_per_meter, 0, '', ' ');?> за м<sup>2</sup>
                                                </div><?php }?>
                                            <?php if($model->price_dollar){?>
                                                <div class="unit-item dollar">
                                                <?php echo number_format($model->price_dollar, 0, '', ' ');?> $<?php echo $price_suf?>
                                                </div><?php }?>
                                            <?php if($model->price_euro){?>
                                                <div class="unit-item evro">
                                                <?php echo number_format($model->price_euro, 0, '', ' ');?> €<?php echo $price_suf?>
                                                </div><?php }?>
                                            <?php if($model->price){?>
                                                <div class="unit-item ruble active">
                                                <?php echo number_format($model->price, 0, '', ' ');?> ₽<?php echo $price_suf?>
                                                </div><?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="deposit-info">
                                    <?php if($model->deposit){?>
                                        <div>Задаток: <span class="deposit-val"><?php echo $model->deposit;?> ₽</span></div>
                                    <?php }?>
                                    <?php if($model->prepayment){
                                        $prepayment = $model->prepayment->value;
                                        if($prepayment != "без предоплаты"){
                                            if ($prepayment == 1){
                                                $prepayment = $prepayment." месяц";
                                            }elseif(4 >= $prepayment && $prepayment  > 1) {
                                                $prepayment = $prepayment . " месяца";
                                            }else{
                                                $prepayment = $prepayment . " месяцев";
                                            }
                                        }
                                        ?>
                                        <div>Предоплата: <span class="prepayment-val"><?php echo $prepayment;?></span></div>
                                    <?php }?>

<!--    --><?php //if($model->price_per_meter){?>
<!--        <div>Цена кв.м: <span class="deposit-val">--><?php //echo $model->price_per_meter;?><!-- ₽</span></div>-->
<!--    --><?php //}?>
                                </div>
                            </div>

                            <div class="catalog-item-data-info">
                                <div class="item-data-title">
                                    Информация
                                </div>
                                <div class="item-data-info-table">
                                    <table>
                                        <?php if ($model->city){?>
                                            <tr>
                                                <td class="data-info-title">Город</td>
                                                <td><?php echo $model->city->title;?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->address){?>
                                            <tr>
                                                <td class="data-info-title">Улица</td>
                                                <td><?php echo $model->address;?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(10)){?>
                                            <tr>
                                                <td class="data-info-title">Кадастровый номер</td>
                                                <td><?php echo $model->getParametr(10);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->objectType){?>
                                            <tr>
                                                <td class="data-info-title">Тип объекта</td>
                                                <td><?php echo $model->objectType->title;?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(26)){?>
                                            <tr>
                                                <td class="data-info-title">Назначение помещения</td>
                                                <td><?php echo $model->getParametr(26);?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(2)){?>
                                            <tr>
                                                <td class="data-info-title">Комнаты</td>
                                                <td><?php echo $model->getParametr(2);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(19)){?>
                                            <tr>
                                                <td class="data-info-title">Вмещаемые машин</td>
                                                <td><?php echo $model->getParametr(19);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(9)){?>
                                            <tr>
                                                <td class="data-info-title">Тип здания</td>
                                                <td><?php echo $model->getParametr(9);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(15)){?>
                                            <tr>
                                                <td class="data-info-title">Этаж</td>
                                                <td><?php echo $model->getParametr(15);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(16)){?>
                                            <tr>
                                                <td class="data-info-title">Всего этажей</td>
                                                <td><?php echo $model->getParametr(16);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(13)){?>
                                            <tr>
                                                <td class="data-info-title">Общая площадь</td>
                                                <td><?php echo $model->getParametr(13);?> м<sup>2</sup></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(14)){?>
                                            <tr>
                                                <td class="data-info-title">Площадь комнат</td>
                                                <td><?php echo $model->getParametr(14);?> м<sup>2</sup></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(21)){?>
                                            <tr>
                                                <td class="data-info-title">Площадь участка</td>
                                                <td><?php echo $model->getParametr(21);?> сот</td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(17)){?>
                                            <tr>
                                                <td class="data-info-title">Площадь кухни</td>
                                                <td><?php echo $model->getParametr(17);?> м<sup>2</sup></td>
                                            </tr>
                                        <?php }?>
                                        <?php
                                        if(!empty($model->getParametr(4)) || !empty($model->getParametr(3))){
                                            if($model->getParametr(3)!="нет" || $model->getParametr(4)!="нет"){
                                                if(!empty($model->getParametr(3))){
                                                if($model->getParametr(3) == 1){
                                                    $balcon = $model->getParametr(3)." балкон";
                                                }elseif($model->getParametr(3) == "нет"){
                                                    $balcon = "";
                                                }else{
                                                    $balcon = $model->getParametr(3)." балкона";
                                                }
                                                }else{
                                                    $balcon = '';
                                                }
                                                if(!empty($model->getParametr(4))){
                                                    if($model->getParametr(4) == 1){
                                                        $logii = $model->getParametr(4)." лоджия";
                                                    }elseif($model->getParametr(4) == "нет"){
                                                        $logii = "";
                                                    }else{
                                                        $logii = $model->getParametr(4)." лоджии";
                                                    }
                                                }else{
                                                    $logii = '';
                                                }

                                                if(!empty($logii) && !empty($balcon)){
                                                    $logii.= ", ";
                                                }


                                                ?>
                                                <tr>
                                                    <td class="data-info-title">Балкон/лоджия</td>
                                                    <td><?php echo $logii?><?php echo $balcon?></td>
                                                </tr>
                                            <?php }}?>
                                        <?php if($model->getParametr(12)){?>
                                            <tr>
                                                <td class="data-info-title">Лифт</td>
                                                <td><?php echo $model->getParametr(12);?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(20)){?>
                                            <tr>
                                                <td class="data-info-title">Отопление</td>
                                                <td><?php echo $model->getParametr(20);?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(22)){?>
                                            <tr>
                                                <td class="data-info-title">Водоснабжение</td>
                                                <td><?php echo $model->getParametr(22);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(23)){?>
                                            <tr>
                                                <td class="data-info-title">Электричество</td>
                                                <td><?php echo $model->getParametr(23);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(1)){?>
                                            <tr>
                                                <td class="data-info-title">Окна</td>
                                                <td><?php echo $model->getParametr(1);?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(24)){?>
                                            <tr>
                                                <td class="data-info-title">Тип гаража</td>
                                                <td><?php echo $model->getParametr(24);?></td>
                                            </tr>
                                        <?php }?>
                                        <?php if($model->getParametr(25)){?>
                                            <tr>
                                                <td class="data-info-title">Тип парковки	</td>
                                                <td><?php echo $model->getParametr(25);?></td>
                                            </tr>
                                        <?php }?>

                                        <?php if($model->getParametr(6)){?>
                                            <tr>
                                                <td class="data-info-title">Ремонт</td>
                                                <td>
                                                    <?php $count =0;
                                                    foreach($model->getParametr(6) as $value){?>
                                                        <?php if ($count == 0){
                                                            echo $value;
                                                        }else{
                                                            echo ", ".$value;
                                                        }?>
                                                        <?php  $count++; }?>

                                                </td>
                                            </tr>
                                        <?php }?>
                                        <?php if(is_array($model->getParametr(7))){?>
                                            <td class="data-info-title">Мебель</td>
                                            <td>
                                                <?php $count =0;
                                                foreach($model->getParametr(7) as $value){?>
                                                    <?php if ($count == 0){
                                                        echo $value;
                                                    }else{
                                                        echo ", ".$value;
                                                    }?>
                                                    <?php  $count++; }?>

                                            </td>
                                            </tr>
                                        <?php }?>

                                        <?php if(is_array($model->getParametr(8))){?>
                                            <tr>
                                                <td class="data-info-title">Удобства</td>
                                                <td>
                                                    <?php $count =0;
                                                    foreach($model->getParametr(8) as $value){?>
                                                        <?php if ($count == 0){
                                                            echo $value;
                                                        }else{
                                                            echo ", ".$value;
                                                        }?>
                                                        <?php  $count++; }?>

                                                </td>
                                            </tr>
                                        <?php }?>
                                        <?php if(!empty($model->getParametr(5)) && $model->getParametr(5) != 'Вариант не выбран'){?>
                                            <tr>
                                                <td class="data-info-title">Расстояние до моря</td>
                                                <td><?php echo $model->getParametr(5);?></td>
                                            </tr>
                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                            <div class="catalog-item-desc-info">
                                <div class="item-data-title">
                                    Описание
                                </div>
                                <div class="item-desc-info">
                                    <?php echo $model->description;?>
                                </div>
                            </div>
                            <div class="print-card">
                                <button class="button--isi button btn-radius print_advert" >
                                    <svg fill="#308fb8" version="1.1" id="Слой_1" x="0px" y="0px" viewBox="0 0 19.8 19.8">
                                        <g>
                                            <path d="M17,6.2H3.2c-0.9,0-1.6,0.7-1.6,1.6v5.8c0,0.9,0.7,1.6,1.6,1.6h1.1v1.6c0,0.9,0.7,1.6,1.6,1.6h8.5c0.9,0,1.6-0.7,1.6-1.6
                                        v-1.6H17c0.9,0,1.6-0.7,1.6-1.6V7.8C18.6,6.9,17.9,6.2,17,6.2z M13.8,16.3H6.4v-3.7h7.4V16.3z M14.9,4.6H5.3V3
                                        c0-0.9,0.7-1.6,1.6-1.6h6.4c0.9,0,1.6,0.7,1.6,1.6V4.6z"/>
                                        </g>
                                    </svg>

                                    Распечатать карточку объекта
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="catalog-item-right">

                            <div class="catalog-item-carousel">
                                <div class="fotorama">
                                    <?php if($model->video){?>
                                        <?php foreach($model->videos as $key => $value){?>
                                            <a href="<?php echo $value->getOriginUrl();?>" data-video="true">
                                                <img src="<?php echo $model->getImage("advertsVideoPrev")->getUrl();?>">
                                            </a>
                                        <?php }?>
                                    <?php }?>

                                    <?php if($model->images){?>
                                        <?php foreach($model->images as $key => $value){?>
                                            <a href="<?php echo $value->getUrl();?>">
                                                <img src="<?php echo $value->getUrl();?>">
                                            </a>
                                        <?php }?>
                                    <?php }?>
                                </div>
                            </div>



                            <div class="mobile-info-box-1 visible-xs">
                                <div class="catalog-item-price-info">
                                    <div class="price-info">
                                        <div class="drop-unit-container">
                                            <span class="unit-selected"><?php echo $model->price;?> Р<?php echo $price_suf?></span>
                                            <button class="choice-unit-drop closed">
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </button>
                                            <div class="unit-list list-items">
                                                <div class="top-border"></div>
                                                <?php if($model->price_dollar){?>
                                                    <div class="unit-item dollar">
                                                    <?php echo $model->price_dollar;?> $<?php echo $price_suf?>
                                                    </div><?php }?>
                                                <?php if($model->price_euro){?>
                                                    <div class="unit-item evro">
                                                    <?php echo $model->price_euro;?> €<?php echo $price_suf?>
                                                    </div><?php }?>
                                                <?php if($model->price){?>
                                                    <div class="unit-item ruble active">
                                                    <?php echo $model->price;?> Р<?php echo $price_suf?>
                                                    </div><?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="deposit-info">
                                        <?php if($model->deposit){?>
                                            <div>Задаток: <span class="deposit-val"><?php echo $model->deposit;?> Р</span></div>
                                        <?php }?>
                                        <?php if($model->prepayment){
                                            $prepayment = $model->prepayment->value;
                                            if($prepayment != "без предоплаты"){
                                                if ($prepayment == 1){
                                                    $prepayment = $prepayment." месяц";
                                                }elseif(4 >= $prepayment && $prepayment  > 1) {
                                                    $prepayment = $prepayment . " месяца";
                                                }else{
                                                    $prepayment = $prepayment . " месяцев";
                                                }
                                            }
                                            ?>
                                            <div>Предоплата: <span class="prepayment-val"><?php echo $prepayment;?></span></div>
                                        <?php }?>
                                    </div>
                                </div>

                                <div class="catalog-item-data-info">
                                    <div class="item-data-title">
                                        Информация
                                    </div>



                                    <!-- show all item -->
                                    <div class="show-all-item" id="dropdown-desc">

                                        <div class="text_box_out">
                                            <div class="item-data-info-table">
                                                <table>
                                                    <?php if ($model->city){?>
                                                        <tr>
                                                            <td class="data-info-title">Город</td>
                                                            <td><?php echo $model->city->title;?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->address){?>
                                                        <tr>
                                                            <td class="data-info-title">Улица</td>
                                                            <td><?php echo $model->address;?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(10)){?>
                                                        <tr>
                                                            <td class="data-info-title">Кадастровый номер</td>
                                                            <td><?php echo $model->getParametr(10);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->objectType){?>
                                                        <tr>
                                                            <td class="data-info-title">Тип объекта</td>
                                                            <td><?php echo $model->objectType->title;?></td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if($model->getParametr(26)){?>
                                                        <tr>
                                                            <td class="data-info-title">Назначение помещения</td>
                                                            <td><?php echo $model->getParametr(26);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(2)){?>
                                                        <tr>
                                                            <td class="data-info-title">Комнаты</td>
                                                            <td><?php echo $model->getParametr(2);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(19)){?>
                                                        <tr>
                                                            <td class="data-info-title">Вмещаемые машин</td>
                                                            <td><?php echo $model->getParametr(19);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(9)){?>
                                                        <tr>
                                                            <td class="data-info-title">Тип здания</td>
                                                            <td><?php echo $model->getParametr(9);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(15)){?>
                                                        <tr>
                                                            <td class="data-info-title">Этаж</td>
                                                            <td><?php echo $model->getParametr(15);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(16)){?>
                                                        <tr>
                                                            <td class="data-info-title">Всего этажей</td>
                                                            <td><?php echo $model->getParametr(16);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(13)){?>
                                                        <tr>
                                                            <td class="data-info-title">Общая площадь</td>
                                                            <td><?php echo $model->getParametr(13);?> м<sup>2</sup></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(14)){?>
                                                        <tr>
                                                            <td class="data-info-title">Площадь комнат</td>
                                                            <td><?php echo $model->getParametr(14);?> м<sup>2</sup></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(21)){?>
                                                        <tr>
                                                            <td class="data-info-title">Площадь участка</td>
                                                            <td><?php echo $model->getParametr(21);?> сот</td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(17)){?>
                                                        <tr>
                                                            <td class="data-info-title">Площадь кухни</td>
                                                            <td><?php echo $model->getParametr(17);?> м<sup>2</sup></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php
                                                    if(!empty($model->getParametr(4)) || !empty($model->getParametr(3))){
                                                        if($model->getParametr(3)!="нет" || $model->getParametr(4)!="нет"){
                                                            if($model->getParametr(3) == 1){
                                                                $balcon = $model->getParametr(3)." балкон";
                                                            }elseif($model->getParametr(3) == "нет"){
                                                                $balcon = "";
                                                            }else{
                                                                $balcon = $model->getParametr(3)." балкона";
                                                            }
                                                            if($model->getParametr(4) == 1){
                                                                $logii = $model->getParametr(4)." лоджия";
                                                            }elseif($model->getParametr(4) == "нет"){
                                                                $logii = "";
                                                            }else{
                                                                $logii = $model->getParametr(4)." лоджии";
                                                            }
                                                            if($model->getParametr(3)!="нет" && $model->getParametr(4)!="нет"){
                                                                $logii= $logii.", ";
                                                            }


                                                            ?>
                                                            <tr>
                                                                <td class="data-info-title">Балкон/лоджия</td>
                                                                <td><?php echo $logii?><?php echo $balcon?></td>
                                                            </tr>
                                                        <?php }}?>
                                                    <?php if($model->getParametr(12)){?>
                                                        <tr>
                                                            <td class="data-info-title">Лифт</td>
                                                            <td><?php echo $model->getParametr(12);?></td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if($model->getParametr(20)){?>
                                                        <tr>
                                                            <td class="data-info-title">Отопление</td>
                                                            <td><?php echo $model->getParametr(20);?></td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if($model->getParametr(22)){?>
                                                        <tr>
                                                            <td class="data-info-title">Водоснабжение</td>
                                                            <td><?php echo $model->getParametr(22);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(23)){?>
                                                        <tr>
                                                            <td class="data-info-title">Электричество</td>
                                                            <td><?php echo $model->getParametr(23);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(1)){?>
                                                        <tr>
                                                            <td class="data-info-title">Окна</td>
                                                            <td><?php echo $model->getParametr(1);?></td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if($model->getParametr(24)){?>
                                                        <tr>
                                                            <td class="data-info-title">Тип гаража</td>
                                                            <td><?php echo $model->getParametr(24);?></td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if($model->getParametr(25)){?>
                                                        <tr>
                                                            <td class="data-info-title">Тип парковки	</td>
                                                            <td><?php echo $model->getParametr(25);?></td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if($model->getParametr(6)){?>
                                                        <tr>
                                                            <td class="data-info-title">Ремонт</td>
                                                            <td>
                                                                <?php $count =0;
                                                                foreach($model->getParametr(6) as $value){?>
                                                                    <?php if ($count == 0){
                                                                        echo $value;
                                                                    }else{
                                                                        echo ", ".$value;
                                                                    }?>
                                                                    <?php  $count++; }?>

                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if(is_array($model->getParametr(7))){?>
                                                        <td class="data-info-title">Мебель</td>
                                                        <td>
                                                            <?php $count =0;
                                                            foreach($model->getParametr(7) as $value){?>
                                                                <?php if ($count == 0){
                                                                    echo $value;
                                                                }else{
                                                                    echo ", ".$value;
                                                                }?>
                                                                <?php  $count++; }?>

                                                        </td>
                                                        </tr>
                                                    <?php }?>

                                                    <?php if(is_array($model->getParametr(8))){?>
                                                        <tr>
                                                            <td class="data-info-title">Удобства</td>
                                                            <td>
                                                                <?php $count =0;
                                                                foreach($model->getParametr(8) as $value){?>
                                                                    <?php if ($count == 0){
                                                                        echo $value;
                                                                    }else{
                                                                        echo ", ".$value;
                                                                    }?>
                                                                    <?php  $count++; }?>

                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                                    <?php if(!empty($model->getParametr(5)) && $model->getParametr(5) != 'Вариант не выбран'){?>
                                                        <tr>
                                                            <td class="data-info-title">Расстояние до моря</td>
                                                            <td><?php echo $model->getParametr(5);?></td>
                                                        </tr>
                                                    <?php }?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="show_all_link_box">
                                            <span class="show_all">Показать полностью</span>
                                        </div>

                                    </div>
                                    <!-- show all item /-->

                                </div>
                            </div>



                            <?php if($model->agent){?>
                                <div class="catalog-item-callback">

                                    <div class="call-operator">
                                        <?php if($model->agent->image){?>
                                            <div class="call-operator-photo" style="background-image: url('<?php echo $model->agent->image->getUrl();?>')"></div>
                                        <?php }?>
                                        <div class="call-operator-name-phone">
                                            <div class="call-operator-name"><?php echo $model->agent->data->first_name;?> <?php echo $model->agent->data->last_name;?></div>
                                            <div class="call-operator-phone"><?php echo $model->agent->data->phone;?></div>
                                        </div>
                                    </div>
                                    <div class="catalog-item-call-button">
                                        <button class="button--isi button btn-radius" data-toggle="modal" data-target="#agentCallBackModal">
                                            Обратный звонок
                                        </button>
                                    </div>

                                </div>
                            <?php }elseif($model->user){?>
                                <div class="catalog-item-callback no-user-photo">

                                    <div class="call-operator">
                                        <div class="call-operator-name-phone">
                                            <div class="call-operator-name"><?php echo $model->user->data->first_name;?> <?php echo $model->user->data->last_name;?></div>
                                            <div class="call-operator-phone"><?php echo $model->user->data->phone;?></div>
                                        </div>
                                    </div>
                                    <div class="catalog-item-call-button">
                                        <button class="button--isi button btn-radius" data-toggle="modal" data-target="#agentCallBackModal">
                                            Обратный звонок
                                        </button>
                                    </div>

                                </div>
                            <?php }?>

                            <div class="catalog-item-map">
                                <div class=googleMap" id="googleMap""></div>
                            </div>


                            <div class="visible-xs">
                                <div class="catalog-item-desc-info">
                                    <div class="item-data-title">
                                        Описание
                                    </div>

                                    <!-- show all item -->
                                    <div class="show-all-item" id="dropdown-info">

                                        <div class="text_box_out">
                                            <div class="item-desc-info">
                                                <?php echo $model->description;?>
                                            </div>
                                        </div>
                                        <div class="show_all_link_box">
                                            <span class="show_all">Показать полностью</span>
                                        </div>

                                    </div>
                                    <!-- show all item /-->

                                </div>
                                <div class="print-card hidden-xs">
                                    <button class="button--isi button btn-radius print_advert" >
                                        <svg fill="#308fb8" version="1.1" id="Слой_1" x="0px" y="0px" viewBox="0 0 19.8 19.8">
                                            <g>
                                                <path d="M17,6.2H3.2c-0.9,0-1.6,0.7-1.6,1.6v5.8c0,0.9,0.7,1.6,1.6,1.6h1.1v1.6c0,0.9,0.7,1.6,1.6,1.6h8.5c0.9,0,1.6-0.7,1.6-1.6
                                        v-1.6H17c0.9,0,1.6-0.7,1.6-1.6V7.8C18.6,6.9,17.9,6.2,17,6.2z M13.8,16.3H6.4v-3.7h7.4V16.3z M14.9,4.6H5.3V3
                                        c0-0.9,0.7-1.6,1.6-1.6h6.4c0.9,0,1.6,0.7,1.6,1.6V4.6z"/>
                                            </g>
                                        </svg>

                                        Распечатать карточку объекта
                                    </button>
                                </div>
                            </div>


                    </div>
                </div>
            </div>
<!-- MY END-->


        </div>
    </div>
    </div>
    <div class="related-nearby">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 section-name">
                    <span class="relate-span">Похожие</span>
                    <div class="drop-unit-container">
                        <div class="related-selected">
                            <span class="blue-label">рядом</span>
                        </div>
                        <button class="related-drop closed">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </button>
                        <div class="related-list list-items" data-href="<?php echo $model->href;?>" data-id="<?php echo $model->id;?>">
                            <div class="top-border"></div>
                            <div class="related-item size" data-size="<?php echo $area;?>">
                                По размеру
                            </div>
                            <div class="related-item price" data-price="<?php echo $model->price;?>">
                                По цене
                            </div>
                            <div class="related-item nearby active" data-city-id="<?php echo $model->city_id;?>">
                                Рядом
                            </div>
                        </div>
                    </div>

                </div>
                <?php Pjax::begin(['id' => 'similarPjax']); ?>
<?php if($dataProvider->getTotalCount() != 0){?>
                <div class="col-xs-12 my-carousel-col">
                        <?=$this->render('beside-list-view',['dataProvider'=>$dataProvider])?>
                </div>

                <div class="col-xs-12">
                    <a href="#" class="view-more">
                        Смотреть больше
                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 14.2 22.7" style="enable-background:new 0 0 14.2 22.7;" xml:space="preserve">
                            <g id="Фигура_3_копия_5">
                                <g>
                                    <polygon points="13.2,11.3 12.2,10.3 12.2,10.3 2.2,0.1 1.2,1.2 11.2,11.3 1.2,21.5 2.2,22.5 12.2,12.4 12.2,12.4 13.2,11.4
                                        13.2,11.3 		"/>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div><?php }?>

                <?php
                $this->registerJs("              
    $(\".related-nearby-carousel\").owlCarousel({
        nav: true,
        navText: [\"<i class='fa fa-angle-left' aria-hidden='true'></i>\",\"<i class='fa fa-angle-right' aria-hidden='true'></i>\"],
        loop: true,
        items: 4,
        mouseDrag: false,
        responsive : {
            768 : {
                items : 3
            },
            0 : {
                items : 1
            },
            992 : {
                items: 4
            }
        }
    });

", yii\web\View::POS_END);
                ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade agents-call-back-modal-block-out" id="agentCallBackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="agents-call-back-modal-block">

            <button data-dismiss="modal" class="close-button"></button>

            <div class="title">
                Обратный звонок
            </div>

            <? $form = \yii\bootstrap\ActiveForm::begin(); ?>

            <?= $form->field($contact, 'agent_id')->hiddenInput(['value'=>$model->user_id])->label(false)?>
            <?= $form->field($contact, 'property_id')->hiddenInput(['value'=>$model->id])->label(false)?>

            <?= $form->field($contact, 'fname')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>
            <?= $form->field($contact, 'phone')->textInput(['placeholder' => 'Телефон'])->label(false)?>
            <?= $form->field($contact, 'message')->textarea(['placeholder' => 'Ваш вопрос'])->label(false)?>
            <?=\yii\helpers\Html::button('Перезвонить', ['type'=>'submit', 'class'=>'button--isi button btn-radius'])?>

            <? \yii\bootstrap\ActiveForm::end(); ?>

        </div>
    </div>
</div>
