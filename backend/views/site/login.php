<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$bundle=\backend\assets\CleanUIAsset::register($this);
$bundleFrontend=\backend\assets\FromtendImagesAsset::register($this);

$this->registerJs('
//            // Form Validation
//            $(\'#form-validation\').validate({
//                submit: {
//                    settings: {
//                        inputContainer: \'.form-group\',
//                        errorListClass: \'form-control-error\',
//                        errorClass: \'has-danger\'
//                    }
//                }
//            });

            // Show/Hide Password
            $(\'.password\').password({
                eyeClass: \'\',
                eyeOpenClass: \'icmn-eye\',
                eyeCloseClass: \'icmn-eye-blocked\'
            });

            // Add class to body for change layout settings
            $(\'body\').addClass(\'single-page single-page-inverse\');

            // Set Background Image for Form Block
            function setImage() {
                var imgUrl = $(\'.page-content-inner\').css(\'background-image\');

                $(\'.blur-placeholder\').css(\'background-image\', imgUrl);
            };

            function changeImgPositon() {
                var width = $(window).width(),
                    height = $(window).height(),
                    left = - (width - $(\'.single-page-block-inner\').outerWidth()) / 2,
                    top = - (height - $(\'.single-page-block-inner\').outerHeight()) / 2;


                $(\'.blur-placeholder\').css({
                    width: width,
                    height: height,
                    left: left,
                    top: top
                });
            };

            setImage();
            changeImgPositon();

            $(window).on(\'resize\', function(){
                changeImgPositon();
            });

            // Mouse Move 3d Effect
            var rotation = function(e){
                var perX = (e.clientX/$(window).width())-0.5;
                var perY = (e.clientY/$(window).height())-0.5;
                TweenMax.to(".effect-3d-element", 0.4, { rotationY:15*perX, rotationX:15*perY,  ease:Linear.easeNone, transformPerspective:1000, transformOrigin:"center" })
            };

            if (!cleanUI.hasTouch) {
                $(\'body\').mousemove(rotation);
            }

',\yii\web\View::POS_READY)

?>
<style>
    h2 svg{
        height: 60px;
    }
    .single-page-block{
        padding-top: 40px;
    }
    .single-page-block-header{
        padding-top: 0px;
        padding-bottom: 30px;
    }
</style>

<section class="page-content">
    <div class="page-content-inner" style="background-image: url(<?=$bundle->baseUrl?>/common/img/temp/login/4.jpg)">

        <!-- Login Page -->
        <div class="single-page-block-header">
            <div class="row">
                <div class="col-lg-6">
                    <img src="">
                    <h2>
                        <?=file_get_contents($bundleFrontend->sourcePath.'/svg-png/logo.svg')?>
                        <?\common\models\Config::getParameter('title')?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="single-page-block">
            <div class="single-page-block-inner effect-3d-element">
                <div class="blur-placeholder"><!-- --></div>
                <div class="single-page-block-form">
                    <h3 class="text-center">
                        <i class="icmn-enter margin-right-10"></i>
                        Вход
                    </h3>
                    <br />
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'username', ['inputOptions'=>['placeholder'=>Yii::t('login','Your Username')]])->label(Yii::t('login','Username')); ?>
                    <?= $form->field($model, 'password', ['inputOptions'=>['placeholder'=>Yii::t('login','Your Password')]])->passwordInput()->label(Yii::t('login','Password')) ?>
                    <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('login','Remember Me')) ?>
                    <div class="row">
                        <div class="col-md-5 center">
                            <?= Html::submitButton(Yii::t('login','Sign in'), ['class' => 'btn btn-primary width-150', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
<!--                    <form id="form-validation" name="form-validation" method="POST">-->
<!--                        <div class="form-group">-->
<!--                            <input id="validation-email"-->
<!--                                   class="form-control"-->
<!--                                   placeholder="Email or Username"-->
<!--                                   name="validation[email]"-->
<!--                                   type="text"-->
<!--                                   data-validation="[EMAIL]">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <input id="validation-password"-->
<!--                                   class="form-control password"-->
<!--                                   name="validation[password]"-->
<!--                                   type="password" data-validation="[L>=6]"-->
<!--                                   data-validation-message="$ must be at least 6 characters"-->
<!--                                   placeholder="Password">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <a href="javascript: void(0);" class="pull-right">Forgot Password?</a>-->
<!--                            <div class="checkbox">-->
<!--                                <label>-->
<!--                                    <input type="checkbox" name="example6" checked>-->
<!--                                    Remember me-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-actions">-->
<!--                            <button type="submit" class="btn btn-primary width-150">Sign In</button>-->
<!--                        </div>-->
<!--                    </form>-->
                </div>
            </div>
        </div>
        <div class="single-page-block-footer text-center">
<!--            <ul class="list-unstyled list-inline">-->
<!--                <li><a href="javascript: void(0);">Terms of Use</a></li>-->
<!--                <li class="active"><a href="javascript: void(0);">Compliance</a></li>-->
<!--                <li><a href="javascript: void(0);">Confidential Information</a></li>-->
<!--                <li><a href="javascript: void(0);">Support</a></li>-->
<!--                <li><a href="javascript: void(0);">Contacts</a></li>-->
<!--            </ul>-->
        </div>
        <!-- End Login Page -->

    </div>

    <!-- Page Scripts -->
    <script>

    </script>
    <!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

<? return;?>

<div class="form-signin">
    <h3><?=Yii::t('login','Sign in to Your Account')?></h3>

    <!-- Row -->
    <div class="row innerLR ">

        <!-- Column -->
        <div class="col-md-12 innerT innerB">
            <div class="innerAll">




            </div>

        </div>
        <!-- // Column END -->





    </div>
    <!-- // Row END -->

<!--    <div class="ribbon-wrapper"><div class="ribbon primary">--><?//=Yii::t('login','members')?><!--</div></div>-->
</div>
<!-- // Box END -->

