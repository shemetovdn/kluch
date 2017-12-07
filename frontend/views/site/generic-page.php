<div class="content-line-padding">
    <div class="container">
        <div class="text-uppercase h1-like"><?=$model->title?></div>
        <?if(isset($model->contents[0]->content)){
            echo $model->contents[0]->content;
        }?>
    </div>
</div>