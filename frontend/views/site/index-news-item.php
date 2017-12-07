
<a href="<?php echo $model->getUrl();?>">
    <div class="carousel-item-img">
        <img src="<?php echo $model->image->getUrl('300x279');?>" alt="">
        <div class="carousel-news-title">
            <?php echo $model->title;?>
        </div>
    </div>
</a>