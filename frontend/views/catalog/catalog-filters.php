<?php
$bundle = \frontend\assets\ImageAsset::register($this);
$nearness = \backend\modules\parametrs\models\Parametrs::getParametrById(5);
$furniture = \backend\modules\parametrs\models\Parametrs::getParametrById(7);
$repairs = \backend\modules\parametrs\models\Parametrs::getParametrById(6);
$comfort = \backend\modules\parametrs\models\Parametrs::getParametrById(8);
$heating = \backend\modules\parametrs\models\Parametrs::getParametrById(20);
$water = \backend\modules\parametrs\models\Parametrs::getParametrById(22);
$electricity = \backend\modules\parametrs\models\Parametrs::getParametrById(23);
$garage_type = \backend\modules\parametrs\models\Parametrs::getParametrById(24);
$parking = \backend\modules\parametrs\models\Parametrs::getParametrById(25);
$target = \backend\modules\parametrs\models\Parametrs::getParametrById(26);

$this->registerJs("

if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
$('#filter_form select.multi-select').multipleSelect(\"uncheckAll\");

}else{
$('#filter_form select.multi-select').val('');
}
", yii\web\View::POS_READY);
?>

<div class="col-xs-12 col-md-3 catalog-filters">
    <form id="filter_form">
        <div class="filters-body">
            <ul>
                <li class="filter_sidebar" data-ids="1,2,5">
                    <div class="item-label">
                        Общая площадь
                    </div>
                    <div class="filter-parameter">
                        <input type="text" name="total_arrea_from">
                        <span>—</span>
                        <input type="text"  name="total_arrea_to">
                        <span class="area-m">m<sup>2</sup></span>
                    </div>
                </li>
                <li data-ids="3">
                    <div class="item-label">
                        Площадь участка
                    </div>
                    <div class="filter-parameter">
                        <input type="text" name="homestead_from">
                        <span>—</span>
                        <input type="text"  name="homestead_to">
                        <span class="area-m">сот</span>
                    </div>
                </li>
                <?php if($nearness){?>
                <li data-ids="1,2,3,4,5,8,">
                    <div class="item-label">
                        Близость к морю
                    </div>
                    <div class="filter-parameter">


                            <select name="nearness" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($nearness as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                    </div>
                </li>
                <?php }?>
                <?php if($target){?>
                <li data-ids="7,">
                    <div class="item-label">
                        Назначение помещения
                    </div>
                    <div class="filter-parameter">


                            <select name="target" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($target as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>

                    </div>
                </li>
                <?php }?>
                <li id="floor" data-ids="1,2,7,9">
                    <div class="item-label">
                        Этаж
                    </div>
                    <div class="filter-parameter">
                        <input type="text" name="floor_from">
                        <span class="from-to-separ">—</span>
                        <input type="text" name="floor_to">
                    </div>
                </li>
                <?php if($repairs){?>
                <li id="repairs" data-ids="1,2,3,5,8,9">
                    <div class="item-label">
                        Ремонт
                    </div>
                    <div class="filter-parameter">
                            <select name="repairs" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($repairs as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                    </div>
                </li>
                <?php }?>
                <?php if($furniture){?>
                <li id="furniture" data-ids="1,2,3,5,8,9">
                    <div class="item-label">
                        Мебель
                    </div>
                    <div class="filter-parameter">
                            <select name="furniture" class="nselect">
                                <option value="">с мебелью</option>
                                <?php foreach ($furniture as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                    </div>
                </li>
                <?php }?>
<!--                <li id="comfort" data-ids="1,2,3,5,8,9">-->
<!--                    <div class="item-label">-->
<!--                        Удобства-->
<!--                    </div>-->
<!--                    <div class="filter-parameter">-->
<!--                        --><?php //if($comfort){?>
<!--                            <select name="comfort[]"   class="multi-select" >-->
<!--                                --><?php //foreach ($comfort as $key => $value){?>
<!--                                    <option value="--><?php //echo $key?><!--">--><?php //echo $value?><!--</option>-->
<!--                                --><?php //}?>
<!--                            </select>-->
<!--                        --><?php //}?>
<!--                    </div>-->
<!--                </li>-->
                <?php if($heating){?>
                <li id="heating" data-ids="3,5">
                    <div class="item-label">
                        Отопление
                    </div>
                    <div class="filter-parameter">

                            <select name="heating" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($heating as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                    </div>
                </li>
                <?php }?>
                <?php if($water){?>
                <li id="water" data-ids="3,4,5">
                    <div class="item-label">
                        Водоснабжение
                    </div>
                    <div class="filter-parameter">
                            <select name="vater" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($water as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>

                            </select>
                        <?php }?>
                    </div>
                </li>
                <?php }?>
                <?php if($electricity){?>
                <li id="electricity" data-ids="3,4,5">
                    <div class="item-label">
                        Электричество
                    </div>
                    <div class="filter-parameter">
                            <select name="electricity" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($electricity as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>
                    </div>
                </li>
                <?php }?>
                <?php if($parking){?>
                <li id="parking" class="garage" data-ids="6">
                    <div class="item-label">
                        Тип парковки
                    </div>
                    <div class="filter-parameter">
                            <select name="parking" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($parking as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>

                    </div>
                </li>
                <?php }?>
                <?php if($garage_type){?>
                <li id="garage_type"  class="garage" data-ids="6">
                    <div class="item-label">
                        Тип гаража
                    </div>
                    <div class="filter-parameter">

                            <select name="garage_type" class="nselect">
                                <option value="">Выберите Вариант</option>
                                <?php foreach ($garage_type as $key => $value){?>
                                    <option value="<?php echo $key?>"><?php echo $value?></option>
                                <?php }?>
                            </select>

                    </div>
                </li>
                <?php }?>
            </ul>
            <div class="filter-bottom-separator"></div>
            <div class="filters-reset">
                <button class="hidden-md hidden-lg apply-filters button--isi button btn-radius filtering_mobail">
                    Применить фильтры
                </button>
                <button type="reset" class="clear-filters">
<!--                    <img src="--><?//=$bundle->baseUrl?><!--/images/svg-png/filters-reset.png" alt="">-->
                    <div class="filters-reset-circle">
                        <svg fill="#4098bd" version="1.1" id="Слой_1" x="0px" y="0px" viewBox="0 0 11.3 11.3" >
                            <g id="Фигура_12_копия">
                                <g>
                                    <polygon  points="11,1 10.3,0.3 5.7,5 1,0.3 0.3,1 5,5.7 0.3,10.3 1,11 5.7,6.4 10.3,11 11,10.3 6.4,5.7 		"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    Очистить фильтры
                </button>
            </div>
        </div>
    </form>
</div>
