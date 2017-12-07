<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */

class CleanUIAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@webroot/cleanui';
    public $css = [
        'https://fonts.googleapis.com/css?family=Raleway',
        'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',

        'vendors/bootstrap/dist/css/bootstrap.min.css',
        'vendors/jscrollpane/style/jquery.jscrollpane.css',
        'vendors/ladda/dist/ladda-themeless.min.css',
        'vendors/select2/dist/css/select2.min.css',
        'vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        'vendors/fullcalendar/dist/fullcalendar.min.css',
        'vendors/cleanhtmlaudioplayer/src/player.css',
        'vendors/cleanhtmlvideoplayer/src/player.css',
        'vendors/bootstrap-sweetalert/dist/sweetalert.css',
        'vendors/summernote/dist/summernote.css',
        'vendors/owl.carousel/dist/assets/owl.carousel.min.css',
        'vendors/ionrangeslider/css/ion.rangeSlider.css',
        'vendors/datatables/media/css/dataTables.bootstrap4.min.css',
        'vendors/c3/c3.min.css',
        'vendors/chartist/dist/chartist.min.css',

        'common/css/source/main.css',
        'custom.css',
    ];
    public $js = [
        'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
        'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',

//        'vendors/jquery/jquery.min.js',
        'vendors/tether/dist/js/tether.min.js',
        'vendors/bootstrap/dist/js/bootstrap.min.js',
        'vendors/jquery-mousewheel/jquery.mousewheel.min.js',
        'vendors/jscrollpane/script/jquery.jscrollpane.min.js',
        'vendors/spin.js/spin.js',
        'vendors/ladda/dist/ladda.min.js',
        'vendors/select2/dist/js/select2.full.min.js',
        'vendors/html5-form-validation/dist/jquery.validation.min.js',
        'vendors/jquery-typeahead/dist/jquery.typeahead.min.js',
        'vendors/jquery-mask-plugin/dist/jquery.mask.min.js',
        'vendors/autosize/dist/autosize.min.js',
        'vendors/bootstrap-show-password/bootstrap-show-password.min.js',
        'vendors/moment/min/moment.min.js',
        'vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        'vendors/fullcalendar/dist/fullcalendar.min.js',
        'vendors/cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js',
        'vendors/cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js',
        'vendors/bootstrap-sweetalert/dist/sweetalert.min.js',
        'vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js',
        'vendors/summernote/dist/summernote.min.js',
        'vendors/owl.carousel/dist/owl.carousel.min.js',
        'vendors/ionrangeslider/js/ion.rangeSlider.min.js',
        'vendors/nestable/jquery.nestable.js',
        'vendors/datatables/media/js/jquery.dataTables.min.js',
        'vendors/datatables/media/js/dataTables.bootstrap4.min.js',
        'vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js',
        'vendors/datatables-responsive/js/dataTables.responsive.js',
        'vendors/editable-table/mindmup-editabletable.js',
        'vendors/d3/d3.min.js',
        'vendors/c3/c3.min.js',
        'vendors/chartist/dist/chartist.min.js',
        'vendors/peity/jquery.peity.min.js',
        'vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js',
        'vendors/gsap/src/minified/TweenMax.min.js',
        'vendors/hackertyper/hackertyper.js',
        'vendors/jquery-countTo/jquery.countTo.js',
        'common/js/common.js',
        'common/js/demo.temp.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jui\JuiAsset'
    ];

//    public static function register($view) {
//        $bundle=parent::register($view);
//        $js = "
//            var basePath = '".$bundle->baseUrl."/';
//            var primaryColor = '#e25f39',
//                dangerColor = '#bd362f',
//                successColor = '#609450',
//                warningColor = '#ab7a4b',
//                inverseColor = '#45484d';
//            var themerPrimaryColor = primaryColor;
//
//        ";
//        $view->registerJs($js, \yii\web\View::POS_END);
//
//        return $bundle;
//    }
}
