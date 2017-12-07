<?php
$bundle = \frontend\assets\ImageAsset::register($this);

?>

<div class="catalog-item-view-on-map">
    <?
        $lat = str_replace(" ","", $model->lat);
        $lng = str_replace(" ","", $model->lng);
        if($lat != '' && $lng != ''){
            $mapinfo = array('lat'=>$lat, 'lng'=>$lng);
            $json = json_encode($mapinfo);
        ?>
            <a class="marker-poss" data-pos='<?=$json?>' style="cursor: pointer;">
                <svg version="1.1" x="0px" y="0px" viewBox="0 0 19.8 19.8" fill="#fff">
                    <g>
                        <path d="M14.7,3.9c-2.5-2.6-6.7-2.6-9.2,0c-2.5,2.6-2.5,6.8,0,9.4l4.6,4.7l4.6-4.7C17.2,10.6,17.2,6.4,14.7,3.9z M10.1,10.8
			                                c-1.2,0-2.2-1-2.2-2.2c0-1.2,1-2.2,2.2-2.2c1.2,0,2.2,1,2.2,2.2C12.2,9.8,11.3,10.8,10.1,10.8z"/>
                    </g>
                </svg>
            </a>
    <?
        }
    ?>
</div>
<div class="catalog-item-img">
    <div class="plushki">
        <?php if($model->reserve == 1){?>
        <div class="reserved">
            <div class="strip">
                Зарезервировано
            </div>
        </div>
        <?php }?>
        <?php if($model->video){?>
            <div class="has-video" style="display: block">
                <i class="fa fa-play-circle" aria-hidden="true"></i>
            </div>
        <?php }?>
    </div>

    <img src="<?=$model->image->getUrl();?>" alt="">

    <div class="catalog-item-id">
        ID <?php echo $model->id;?>
    </div>
</div>
<div class="catalog-item-info">
<a href="<?php echo $model->getUrl();?>">
    <div class="catalog-item-title">
        <div class="substrate-map-btn"></div>
        <?php echo $model->title;?>
    </div>
    <div class="catalog-item-data-mobile visible-xs">
        <?php if(!empty($model->city->title)){ ?><span><?php echo $model->city->title;?></span>,<?php }?>
        <?php if(!empty($model->address)){ ?><span><?php echo $model->address;?></span>,<?php }?>
        <?php
        $room =   $model->room;
        if($room != ''&& $room != 'студия'){
            $room = $room.'-комн.';
        }  elseif($room == 'студия'){}
        ?>
        <?php if(!empty($room)){?>
        <span><?php echo $room;?></span><?php } ?><?php if(!empty($model->getParametr(13)))
        {?>,<span><?php echo $model->getParametr(13);?>  M<sup>2</sup></span>
        <?php }?>
    </div>
    <table class="catalog-item-data hidden-xs">
        <?php if(!empty($model->city->title)){ ?>
        <tr>
            <th class="item-label hidden-xs">Город</th>
            <th><?php echo $model->city->title;?></th>
        </tr>
        <?php }?>
        <?php if(!empty($model->address)){ ?>
        <tr>
            <th class="item-label hidden-xs">Адрес</th>
            <th><?php echo $model->address;?></th>
        </tr>
        <?php }?>
        <?php if(!empty($model->room)){ ?>
        <tr>
            <th class="item-label hidden-xs">Комнат</th>
            <th><?php echo $model->room;?></th>
        </tr>
        <?php }?>
        <?php if(!empty($model->getParametr(13))){ ?>
        <tr>
            <th class="item-label hidden-xs">Площадь</th>
            <th><?php echo $model->getParametr(13);?> M<sup>2</sup></th>
        </tr>
        <?php }?>
    </table>
    <div class="catalog-item-price">
        <div class="price"><?php echo number_format($model->price, 0, '', ' ');?> ₽</div>
        <div class="read-more">
            <div class="button--isi button btn-radius">Подробнее</div>
        </div>
    </div>
</a>
</div>