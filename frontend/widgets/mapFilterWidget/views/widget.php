<?php
    $bundle = \frontend\assets\ImageAsset::register($this);
    $cities = \backend\modules\regions\models\Regions::getList('id', 'title', 'id desc');
    $category = \backend\modules\categories\models\Category::find()->asArray()->all();
    $objects = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['status' => 1])->asArray()->all();
$rooms = \backend\modules\parametrs\models\Parametrs::getParametrById(2);
$cars = \backend\modules\parametrs\models\Parametrs::getParametrById(19);
?>

<div class="col-xs-12">
    <form class="search-form">
        <div class="search-block">
            <div class="search-bar">
                <ul class="hidden-sm hidden-xs">
                    <li>
                        <select class="nselect category_list" name="category">
                            <?php if(is_array($category)){?>
                                <?php foreach ($category as $key => $value){?>
                                    <option value="<?php echo $value['id'];?>" data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>
                                <?php }}?>
                        </select>
                    </li>
                    <li>
                        <select class="nselect object_list" name="object">
                            <option value="">Тип объекта</option>
                            <?php if(is_array($objects)){?>
                                <?php foreach ($objects as $key => $value){?>
                                    <option value="<?php echo $value['id'];?>" data-href="<?php echo $value['href'];?>"><?php echo $value['title'];?></option>

                                <?php }}?>
                        </select>
                    </li>
                    <li id="rooms">
                        <select  class="multi-select" multiple="multiple" name="rooms[]"  title="Количество комнат">
                            <?php foreach ($rooms as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li id="cars" >
                        <select  class="multi-select" multiple="multiple" name="cars[]"  title="Количество машин">
                            <?php foreach ($cars as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li id="area">
                        <div  class="price-filter" style="width: 260px;padding: 0;text-align: center;">
                            <div  style="float: none">
                                <input name="area-from" type="text" placeholder="от" style="width: 80px">
                                <span class="price-separ">—</span>
                                <input name="area-to" type="text" placeholder="до" style="width: 80px">
                                <span id="units">сот</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="city-filter">
                            <select class="nselect" name="city">
                                <?php if(is_array($cities)){?>
                                    <option value="">Выберите Город</option>
                                    <?php foreach ($cities as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </li>
                    <li class="li-price">
                        <div class="price-filter">
                            <input name="price-from" type="number" placeholder="от">
                            <span class="price-separ">—</span>
                            <input name="price-to" type="number" placeholder="до">
                            <span>₽</span>
                        </div>
                    </li>
                    <li class="search-now">
                        <a href="#" id="map_filter">
                            <img src="<?=$bundle->baseUrl?>/images/svg-png/search.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>