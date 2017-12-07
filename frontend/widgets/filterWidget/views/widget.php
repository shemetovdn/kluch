<?php
    $bundle = \frontend\assets\ImageAsset::register($this);
    $cities = \backend\modules\regions\models\Regions::getList('id', 'title', 'id desc');
    $category = \backend\modules\categories\models\Category::find()->asArray()->all();
    $objects = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['status' => 1])->andWhere(['like','category_ids',''.$category_id.''])->asArray()->all();
$rooms = \backend\modules\parametrs\models\Parametrs::getParametrById(2);
$cars = \backend\modules\parametrs\models\Parametrs::getParametrById(19);

$city_id = '';
$cars_ids = '';
$rooms_ids = '';
if(!empty($filter_params)){
    $area_from = $filter_params["area-from"];
    $area_to = $filter_params["area-to"];
    $city_id = $filter_params["city"];
    $price_from = $filter_params["price-from"];
    $price_to = $filter_params["price-to"];
    if(isset($filter_params["rooms"])){$rooms_ids = $filter_params["rooms"];}
    if(isset($filter_params["cars"])){$cars_ids = $filter_params["cars"];}
}
if(is_array($rooms_ids) && !empty($rooms_ids)){ $rooms_ids = implode(',', $rooms_ids);}
else{$rooms_ids = implode(',', array());}
if(is_array($cars_ids) && !empty($cars_ids)){    $cars_ids = implode(',', $cars_ids);
}else{$cars_ids = implode(',', array());}

$this->registerJs("
var rooms = '".$rooms_ids."'.split(',');
var cars = '".$cars_ids."'.split(',');
if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
$('#rooms > select.multi-select').multipleSelect('setSelects', rooms);
$('#cars > select.multi-select').multipleSelect('setSelects', cars);
}
", yii\web\View::POS_READY);
?>
<div class="col-xs-12">
    <form class="search-form catalog_filter">
        <div class="search-block">
            <div class="search-bar">
                <ul>
                    <li>
                        <div class="item-label hidden-md hidden-lg">
                            Что хотите?
                        </div>
                        <div class="filter-parameter">
                            <select class="nselect category_list" name="category" >
                                <?php if(is_array($category)){?>
                                    <option value="">Категория</option>
                                    <?php foreach ($category as $key => $value){?>
                                        <option value="<?php echo $value['id'];?>"
                                                <?php if($value['id'] == $category_id){ echo "selected";}?>
                                                data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>
                                    <?php }}?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="item-label hidden-md hidden-lg">
                            Тип недвижимости
                        </div>
                        <div class="filter-parameter">
                            <select class="nselect object_list" name="object">
                                <option value="">Тип объекта</option>
                                <?php if(is_array($objects)){?>
                                    <?php foreach ($objects as $key => $value){?>
                                        <option value="<?php echo $value['id'];?>"
                                            <?php if($value['id'] == $object_id){ echo "selected";}?>
                                                data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>

                                    <?php }}?>
                            </select>
                        </div>
                    </li>
                    <li id="rooms">
                        <div class="item-label hidden-md hidden-lg">
                            Количество комнат
                        </div>
                        <div class="filter-parameter">
                            <select  class="multi-select" multiple="multiple" name="rooms[]" title="Количество комнат">
                                <?php foreach ($rooms as $key => $value){?>
                                    <option  value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                        </div>
                    </li>
                    <li id="cars"  class="hide">
                        <div class="item-label hidden-md hidden-lg">
                            Количество машин
                        </div>
                        <div class="filter-parameter">
                            <select  class="multi-select" multiple="multiple" name="cars[]" title="Количество машин">
                                <?php foreach ($cars as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                        </div>
                    </li>
                    <li id="area" class="hide">
                        <div class="item-label hidden-md hidden-lg">
                            Площадь
                        </div>
                        <div class="filter-parameter">
                            <div  class="price-filter" style="width: 260px;padding: 0;text-align: center;">
                                <div  style="float: none">
                                    <input name="area-from" type="text" placeholder="от" value="<?php echo !empty($area_from)?$area_from:"";?>" style="width: 80px">
                                    <span class="price-separ">—</span>
                                    <input name="area-to" type="text" placeholder="до" value="<?php echo !empty($area_from)?$area_to:"";?>" style="width: 80px">
                                    <span id="units">сот</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-label hidden-md hidden-lg">
                            Расположение
                        </div>
                        <div class="filter-parameter">
                            <div class="city-filter">
                                <select class="nselect" name="city">
                                    <?php if(is_array($cities)){?>
                                        <option value="">Город</option>
                                        <?php foreach ($cities as $key => $value){?>
                                    <option value="<?php echo $key?>" <?php if($key == $city_id){ echo "selected";}?>><?php echo $value?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li class="li-price">
                        <div class="item-label hidden-md hidden-lg">
                            Цена
                        </div>
                        <div class="filter-parameter">
                            <div class="price-filter">
                                <input name="price-from" placeholder="от">
                                <span class="price-separ">—</span>
                                <input name="price-to" placeholder="до">
                                <span>₽</span>
                            </div>
                        </div>
                    </li>
                    <li class="search-now hidden-xs hidden-sm">
                        <a href="#">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/search.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>