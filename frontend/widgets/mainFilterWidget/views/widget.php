<?php
use yii\helpers\Url;
    $bundle = \frontend\assets\ImageAsset::register($this);
    $cities = \backend\modules\regions\models\Regions::getList('id', 'title', 'id desc');
    $category = \backend\modules\categories\models\Category::find()->asArray()->all();
    $objects = \backend\modules\objectTypes\models\ObjectTypes::find()->where(['status' => 1])->all();
$rooms = \backend\modules\parametrs\models\Parametrs::getParametrById(2);
$cars = \backend\modules\parametrs\models\Parametrs::getParametrById(19);
?>

<div class="col-xs-12">
    <form class="search-form main_filter" method="post" action="<?= Url::to(['catalog/index']);?>" id="search_form" data-category="kupit">
        <div class="search-block">
            <div class="search-bar">
                <ul>
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
                                    <option value="<?php echo $value->id;?>" data-href="<?php echo $value->href;?>" data-image="<?php echo $value->image->getUrl();?>"><?php echo $value->title;?></option>

                                <?php }}?>
                        </select>
                    </li>
                    <li id="rooms">
                        <select  class="multi-select" multiple="multiple" name="rooms[]" title="Количество комнат">
                            <?php foreach ($rooms as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li id="cars" class="hide">
                        <select  class="multi-select" multiple="multiple" name="cars[]" title="Количество машин">
                            <?php foreach ($cars as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li id="area" class="hide">
                        <div  class="price-filter" style="width: 260px;padding: 0;text-align: center;">
                            <div  style="float: none">
                                <input name="area-from" type="text" placeholder="от" style="width: 80px" class="money-format">
                                <span class="price-separ">—</span>
                                <input name="area-to" type="text" placeholder="до" style="width: 80px" class="money-format">
                                <span id="units">сот</span>
                            </div>
                        </div>
                    </li>
                    <li class="li-city">
                        <div class="city-filter">
                            <select class="nselect" name="city">
                                <?php if(is_array($cities)){?>
                                    <option value="">Город</option>
                                    <?php foreach ($cities as $key => $value){?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </li>
                    <li class="li-price">
                        <div class="price-filter">
                            <input name="price-from" placeholder="от">
                            <span class="price-separ">—</span>
                            <input name="price-to" placeholder="до">
                            <span>₽</span>
                        </div>
                    </li>
                    <div class="div-search-id">
                        <input type="text" placeholder="Введите ID квартиры">
                    </div>
                    <div class="clear"></div>
                </ul>

                <div class="search-bar-sub">
                    <div class="search-for-id deactivated">Искать по ID</div>

                    <button type="button" data-toggle="modal" data-target="#modal-map">
                        <img src="<?=$bundle->baseUrl?>/images/svg-png/view_on_map.png" alt="">Показать на карте
                    </button>

                </div>
            </div>
            <div class="search-bar-submit">
                <button class="button--isi button btn-radius">Подобрать</button>
            </div>

            </div>
        </div>
    </form>
</div>