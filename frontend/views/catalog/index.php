<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$bundle = \frontend\assets\ImageAsset::register($this);
$nearness = \backend\modules\parametrs\models\Parametrs::getParametrById(5);
$furniture = \backend\modules\parametrs\models\Parametrs::getParametrById(7);
$repairs = \backend\modules\parametrs\models\Parametrs::getParametrById(6);
?>
<?php
$title ="";
$subtitle = "";
$category_href = "";
$object_href = "";
$category_id = "";
$object_id = "";
if(!empty($category)){
    $category_id = $category->id;
    $category_href = $category->href;
    if($category->id == 1){
        $title .= "Продажа ";
        $subtitle = "Продажа недвижимости";
    }elseif($category->id == 2){
        $title .= "Долгосрочная аренда ";
        $subtitle = "Долгосрочная аренда";
    }elseif($category->id == 3) {
        $title .= "Краткосрочная аренда ";
        $subtitle = "Краткосрочная аренда";
    }

}else{
    $subtitle = "Каталог";
}
$object_id ='';
if(!empty($object)) {
    $object_href = $object->href;
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
    } elseif (empty($object->id)) {
        $title = "";
    }
    $object_id = $object->id;
}else{
    $title = "";
}

if($exclusive == "exclusive"){
    $title = "Эксклюзивная продажа";
    $subtitle = "";
    $object_href = "exclusive";
    if($arenda == "arenda"){
        $title = "Эксклюзивная аренда";
    }
}else{
    if($arenda == "arenda"){
        $category_href = "arenda";
        $title = "Аренда недвижимости";
    }
}

?>
<input type="hidden" value='<?php echo json_encode($url);?>' id="url">
<section>
    <div class="custom-page catalog">
        <div class="container">
            <div class="row">
                <div class="hidden-xs col-xs-12 breadcrumbs">
                    <?php if(!empty($title)){
                        $this->title = $title;
                    }else{
                        if(!empty($subtitle)){
                            $this->title = $subtitle;
                        }
                    }?>
                    <a href="<?=Url::to(['site/index'])?>">Главная</a><?php
                    if(!empty($subtitle))
                    {?>
                        —
                        <?php if(!empty($title)){?><a href='<?php echo  Url::to(['/catalog/'.$category_href]);?>'><?php }?>
                        <span class="page-subtitle"><?php echo $subtitle;?></span>
                        <?php if(!empty($title)){?></a><?php }?>
                    <?php }?>
                    <?php if(!empty($title))
                    {?>
                        —
<!--                        <a href='--><?php //echo  Url::to(['/catalog/'.$category_href.'/'.$object_href]);?><!--'>-->
                        <span class="page-title"><?php echo $title; ?></span>
<!--                        </a>-->
              <?php }?>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 page-name">
                            <span class="page-title"><?php echo $title;?></span>
                            <div class="number-of-offers"></div>
                            <button class="button--isi button btn-radius  look-at-map" >
                                <svg version="1.1" x="0px" y="0px" viewBox="0 0 19.8 19.8" fill="#308fb8">
                                    <g>
                                        <path d="M14.7,3.9c-2.5-2.6-6.7-2.6-9.2,0c-2.5,2.6-2.5,6.8,0,9.4l4.6,4.7l4.6-4.7C17.2,10.6,17.2,6.4,14.7,3.9z M10.1,10.8
			                                c-1.2,0-2.2-1-2.2-2.2c0-1.2,1-2.2,2.2-2.2c1.2,0,2.2,1,2.2,2.2C12.2,9.8,11.3,10.8,10.1,10.8z"/>
                                    </g>
                                </svg>
                                Смотреть на карте</button>
                        </div>
                    </div>
                </div>

                <div class="filters-block">

                    <!--<div class="col-xs-12 hidden-md hidden-lg">-->
                    <div id="filtersCall" class="filtersCall closed hidden-md hidden-lg">
                        <span class="filter-logo"><img src="<?=$bundle->baseUrl?>/images/svg-png/filter.svg" alt=""></span>
                        Фильтры
                        <span class="filter-caret"><img src="<?=$bundle->baseUrl?>/images/svg-png/arrowdown.png" alt=""></span>
                    </div>
                    <!--</div>-->

                    <div class="filter-wrapper">

                <?= \frontend\widgets\filterWidget\FilterWidget::widget([
                    'category_id' =>  $category_id,
                    'object_id' =>  $object_id,
                    'filter_params' => $filter_params,
                ])?>

                <?=$this->render('catalog-filters')?>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 catalog-list">
                    <?php Pjax::begin(['id' => 'catalogPjax']); ?>
                    <?=$this->render('catalog-list-view',['dataProvider'=>$dataProvider])?>
                    <?=$this->render('total-map', ['totaladverts'=>$totaladverts])?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .catalog .dv-filter-on-map{
        display: none;
    }
</style>
