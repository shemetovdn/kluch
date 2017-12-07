<?php

use yii\bootstrap\ActiveForm;

$bundle = \app\assets\AppAsset::register($this);

$form = ActiveForm::begin(
    [
        'action' => ['cart/step2'],
        'id' => 'billing-form',
        'validateOnChange' => true,
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}", //\n{hint}\n{error}
            'horizontalCssClasses' => [
                'label' => 'col-md-3',
                'offset' => '',
                'wrapper' => 'col-md-9',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]
);

$this->registerJs('
    var confirmation=false;
    $("#billing-form").on("beforeSubmit", function (event, messages) {
        if(!confirmation){
            $("#confirmation").click();
            return false;
        }
    });
',\yii\web\View::POS_END);
?>

<a <?=\wbp\uniqueOverlay\UniqueOverlay::widget([
    'url'=>\yii\helpers\Url::to(['cart/confirmation'])
])?> id="confirmation"></a>

<div class="bord-shop">
    <div class="check-l">Check out</div>
    <?
    if (Yii::$app->user->id) {
        echo '
                                <div class="check-r">signed in ' . Yii::$app->user->identity->name . '!</div>
                            ';
    }
    ?>
    <div style="clear:both;"></div>
</div>
<!-- -->
<div class="sh_dawn_menu">
    <div class="sh-but_menu">
        <div class="sh_title_menu">
            <div class="faq-text">1. Addresses</div>
            <div class="faq-ar"><img src="<?=$bundle->baseUrl ?>/images/arrow-lin.png" alt=""/>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="sh_drop_dawn">
        <div style="clear:both; height:22px;"></div>
        <?=$this->render(Yii::$app->controller->viewsPath.'addressForm',['form'=>$form,'formModel'=>$billingAddress,'title'=>'billing address'])?>

        <div style="clear:both; height:30px;"></div>

        <?=$this->render(Yii::$app->controller->viewsPath.'addressForm',['form'=>$form,'formModel'=>$shippingAddress,'isShippingAddress'=>1,'title'=>'shipping address'])?>
        <div style="clear:both; height:30px;"></div>

    </div>
</div>
<!-- -->

<!-- -->
<?=$this->render(Yii::$app->controller->viewsPath.'Payment',['paymentMethods'=>$paymentMethods,'form'=>$form])?>
<div style="clear:both; height:30px;"></div>
<div class="bord-btn">
    <?= \yii\helpers\Html::submitButton( 'PAY' ,['class' => 'btn-add']) ?>
</div>
<? \yii\bootstrap\ActiveForm::end(); ?>