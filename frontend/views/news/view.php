<?php
use yii\helpers\Url;
use backend\modules\seo\models;

//$this->seo::setMeta();

$bundle=\frontend\assets\AppAsset::register($this);
$this->title = $article->title;

//$this->og_title = 'Title from view';

// Google
$this->registerJsFile('https://apis.google.com/js/platform.js');
// Google END

$curentUrl = Url::to(['news'. '/' . $article->href], true);
$imageUrl = Url::to([$article->image->getUrl()], true);
$mailImageUrl = '';
if ($article->image->id){
    $mailImageUrl = '&image_url='.$imageUrl;
}
?>

<section>
    <div class="custom-page inner-page">

        <div class="inner-banner" style="background-image: url('<?=$article->image->getUrl()?>')">

            <div class="container">
                <div class="row">
                    <div class="filters-block">

                        <div id="filtersCall" class="filtersCall closed hidden-md hidden-lg">
                            <span class="filter-logo"><img src="<?=$bundle->baseUrl?>/images/svg-png/search-blue.png" alt=""></span>
                            Искать недвижимость
                            <span class="filter-caret"><img src="<?=$bundle->baseUrl?>/images/svg-png/arrowdown.png" alt=""></span>
                        </div>

                        <div class="filter-wrapper">

                            <?= \frontend\widgets\otherFilterWidget\OtherFilterWidget::widget()?>
                        </div>
                    </div>

                    <div class="hidden-xs col-sm-12 breadcrumbs">
                        <a href="<?=Url::to(['site/index'])?>">Главная</a> —
                        <a href="<?=Url::to(['news/view', 'href'=>$article->href])?>"><?=$article->title?></a>
                    </div>

                </div>
            </div>

            <div class="banner-title-box">
                <div class="title">
                    <?=$article->title?>
                </div>
            </div>

        </div>

        <div class="content">
            <div class="container">
                <div class="from-admin-panel">
                    <?=$article->description?>
                </div>
            </div>
        </div>

        <div class="share">
            <div class="container">
                <div class="row col-xs-12">
                    <div class="share-box">
                        <div class="title">
                            Поделиться
                        </div>

                        <div class="sharethis-inline-share-buttons">

                            <a href="https://vk.com/share.php?url=<?=$curentUrl?>" target="_blank">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_03.png" alt="">
                            </a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$curentUrl?>" target="_blank">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_05.png" alt="">
                            </a>
                            <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=<?=$curentUrl?>" target="_blank">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_07.png" alt="">
                            </a>
                            <a href="//plus.google.com/share?app=110&amp;url=<?=$curentUrl?>" target="_blank" onclick="window.open(this.href,'','scrollbars=1,width=400,height=620');return false;">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_09.png" alt="">
                            </a>
                            <a href="http://twitter.com/share?text=<?=$article->title?>&url=<?=$curentUrl?>" title="Поделиться ссылкой в Твиттере" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" target="_parent">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_11.png" alt="">
                            </a>
                            <a href="http://www.livejournal.com/update.bml?subject=<?=$article->title?>&event=%3Ca%20href=%22<?=$curentUrl?>%22%3E<?=$article->title?>%3C/a%3E&prop_taglist=expange" target="_blank">
                                <img src="<?=$bundle->baseUrl?>/images/social-share_13.png" alt="">
                            </a>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</section>