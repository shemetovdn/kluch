<?php
$bundle = \frontend\assets\ImageAsset::register($this);

$this->registerJs("
$(document).ready(function(){
        $('.lightbox .prev-next-container').css('display', 'none');
  });
    ", yii\web\View::POS_READY);
?>

<div class="content">
    <div class="about-me">
        <div class="about-me-geren-bg"></div>
        <div class="container">
            <div class="row">
                <div class="about-me-photo col-xs-12 col-sm-4 col-md-5">
                    <img src="<?=$model->image->getUrl()?>" alt="">
                </div>
                <div class="about-me-post col-xs-12 col-sm-8 col-md-7 col-lg-offset-1 col-lg-6">
                    <div class="about-me-post-name">
                        <?=$model->title?>
                    </div>
                    <div class="about-me-post-under-name">
                        <?=$model->short_description?>
                    </div>
                    <div class="about-me-post-text">
                        <?=$model->contents[0]->content?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= \frontend\widgets\ourClientsWidget\OurClientsWidget::widget(); ?>

    <!-- ===== REVIEWS SECTION ===== -->
    <?
        if($testimonials->count){
    ?>
            <div class="ebout-me-reviews">
                <div class="container">
                    <div class="section-name section-name-review">
                        ОТЗЫВЫ
                    </div>
                </div>

                <?
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $testimonials,
                    'itemView' => '_testimonial',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'reviews-list',
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'review-item',
                    ],
                    'summary' => false,
                ]);
                ?>
            </div>
    <?
        }
    ?>


</div>