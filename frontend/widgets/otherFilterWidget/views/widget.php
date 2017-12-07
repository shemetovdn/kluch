<?php
use yii\helpers\Url;
    $bundle = \frontend\assets\ImageAsset::register($this);
    $cities = \backend\modules\regions\models\Regions::getList('id', 'title', 'id desc');
    $category = \backend\modules\categories\models\Category::find()->asArray()->all();
    $objects = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['status' => 1])->asArray()->all();
$rooms = \backend\modules\parametrs\models\Parametrs::getParametrById(2);
$cars = \backend\modules\parametrs\models\Parametrs::getParametrById(19);
$category_id = '';
$object_type_id = '';
$city_id = '';

if(isset($model)){
    $category_id = "$model->category_id";
    $object_type_id = "$model->object_type_id";
    $city_id = "$model->city_id";
}
?>

<div class="col-xs-12">
    <form class="search-form"  method="post" action="<?= Url::to(['catalog/index']);?>" id="search_form" data-category="kupit">
        <div class="search-block">
            <div class="search-bar">
                <ul>
                    <li>
                        <div class="item-label hidden-md hidden-lg">
                            Что хотите?
                        </div>
                        <div class="filter-parameter">
                            <select class="nselect category_list" name="category">
                                <?php if(is_array($category)){?>
                                    <?php foreach ($category as $key => $value){?>
                                        <option
                                            <?php if($value['id'] == $category_id){ echo "selected";}?>
                                                value="<?php echo $value['id'];?>" data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>
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
                                        <option
                                            <?php if($value['id'] == $object_type_id){ echo "selected";}?>
                                                value="<?php echo $value['id'];?>" data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>

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
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                        </div>
                    </li>
                    <li id="cars" class="hide">
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
                                    <input name="area-from" type="text" placeholder="от" style="width: 80px">
                                    <span class="price-separ">—</span>
                                    <input name="area-to" type="text" placeholder="до" style="width: 80px">
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
                                            <option
                                                <?php if($key == $city_id){ echo "selected";}?>
                                                    value="<?php echo $key?>"><?php echo $value?></option>
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
                        <a href="#" class="submit_form">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/search.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>