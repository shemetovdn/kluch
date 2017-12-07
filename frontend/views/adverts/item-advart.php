<a href="<?php echo $model->getUrl();?>" data-pjax="false">
<div class="carousel-item-img">
    <?php if($model->video){?>
        <div class="has-video">
            <i class="fa fa-play-circle" aria-hidden="true"></i>
        </div>
    <?php }?>
<img src="<?php echo $model->image->getUrl('360x250');?>" alt="<?php echo $model->title;?>">
    <div class="carousel-item-price">
        <?php echo $model->price;?> ₽
        <div class="price-bottom-line"></div>
    </div>
</div>
<div class="carousel-item-desc">
    <a href="<?php echo $model->getUrl();?>" data-pjax="false">
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
</a>