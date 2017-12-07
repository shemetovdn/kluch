<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>

<div class="container">

    <!-- Box -->
    <div class="hero-unit well">



        <h1><?= Html::encode($this->title) ?></h1>
        <hr class="separator" />

        <!-- Row -->
        <div class="row row-merge">

            <!-- Column -->
            <div class="col-md-9">
                <div class="innerAll">
                    <p>
                        <?= nl2br(Html::encode($message)) ?>
                    </p>
                </div>
            </div>
            <!-- // Column END -->

            <!-- Column -->
            <div class="col-md-3">
                <div class="innerAll center">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?=Yii::$app->getUrlManager()->createUrl('')?>" class="btn btn-block btn-success"><?=Yii::t('admin','Go back to')?> <br/> <?=Yii::t('admin','Homepage')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Column END -->

        </div>
        <!-- // Row END -->


    </div>
</div>
