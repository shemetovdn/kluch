

    <div class="carousel-item-img">
        <?php if($model->video){?>
            <div class="has-video">
                <i class="fa fa-play-circle" aria-hidden="true"></i>
            </div>
        <?php }?>
        <?php if($model->reserve == 1){?>
            <div class="reserved">
                <div class="strip">
                    Зарезервировано
                </div>
            </div>
        <?php }?>
       <div class="newcarousel built-in-carousel">
            <?php if($model->images){?>
            <?php foreach($model->images as $key => $value){?>
                    <img src="<?php echo $value->getUrl('360x250');?>" alt="">
            <?}?>
            <?}?>
        </div>
        <div class="carousel-item-price">
            <?php echo number_format($model->price, 0, '', ' ');?> ₽
            <div class="price-bottom-line"></div>
        </div>
    </div>
    <div class="carousel-item-desc">
        <a href="<?php echo $model->getUrl();?>">
        <div class="carousel-item-title">
            <?php echo $model->title;?>
        </div>
            <div class="carousel-item-options">
                <?php
                $room =   $model->room;
                if($room != ''&& $room != 'студия'){
                    $room = $room.'-комн.';
                }  elseif($room == 'студия'){
                }
                ?>
                <?php echo $model->city->title;?><?php if($room){echo ', '.$room;}?><?php if($model->getParametr(13)){ echo ', '.$model->getParametr(13).' м<sup>2</sup>';};?>
            </div>
        </a>
    </div>
