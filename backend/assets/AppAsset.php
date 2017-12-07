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

class AppAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@webroot/files';
    public $css = [
        'fonts/font-awesome/css/font-awesome.css',
        'fonts/glyphicons/css/glyphicons_social.css',
        'fonts/glyphicons/css/glyphicons_filetypes.css',
        'fonts/glyphicons/css/glyphicons_regular.css',
//        'fonts/font-awesome/css/font-awesome.min.css',
        'scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css',
        'scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css',
        'scripts/plugins/color/jquery-miniColors/jquery.miniColors.css',
        'scripts/plugins/notifications/notyfy/jquery.notyfy.css',
        'scripts/plugins/notifications/notyfy/themes/default.css',
        'scripts/plugins/notifications/Gritter/css/jquery.gritter.css',
        'scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.css',
        'scripts/plugins/other/google-code-prettify/prettify.css',
        'scripts/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css',
        'scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css',
        'bootstrap/extend/bootstrap-switch/static/stylesheets/bootstrap-switch.css',
        'scripts/plugins/forms/select2/select2.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',

        'css/style-light.css',
        'skins/css/cyan.css',
    ];
    public $js = [
        'scripts/plugins/other/excanvas/excanvas.js',
        'scripts/plugins/system/less.min.js',
        'scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
        'scripts/plugins/system/modernizr.js',
        'scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js',
        'scripts/demo/common.js',
        'scripts/plugins/other/holder/holder.js',
        'scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js',
        'scripts/plugins/gallery/prettyphoto/js/jquery.prettyPhoto.js',

        'bootstrap/extend/bootstrap-select/bootstrap-select.js',
	    'bootstrap/extend/bootstrap-switch/static/js/bootstrap-switch.js',
	    'bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js',
//	    'bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js',
	    'bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js',
	    'bootstrap/extend/bootbox.js',
//	    'bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js',
//	    'bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js',

        'scripts/plugins/other/google-code-prettify/prettify.js',
        'scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js',
        'scripts/plugins/notifications/notyfy/jquery.notyfy.js',
        'scripts/plugins/color/jquery-miniColors/jquery.miniColors.js',
        'scripts/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        'scripts/plugins/system/jquery.cookie.js',

        'scripts/demo/themer.js',
//        'scripts/demo/twitter.js',
        'scripts/plugins/charts/easy-pie/jquery.easypiechart.js',
        'scripts/plugins/charts/sparkline/jquery.sparkline.min.js',
        'scripts/plugins/other/jquery.ba-resize.js',
//        'scripts/demo/index.js',
        'scripts/plugins/charts/flot/jquery.flot.js',
        'scripts/plugins/charts/flot/jquery.flot.pie.js',
        'scripts/plugins/charts/flot/jquery.flot.tooltip.js',
        'scripts/plugins/charts/flot/jquery.flot.selection.js',
        'scripts/plugins/charts/flot/jquery.flot.resize.js',
        'scripts/plugins/charts/flot/jquery.flot.orderBars.js',
        'scripts/plugins/charts/flot/jquery.flot.time.js',
        'scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js',
        'scripts/plugins/forms/select2/select2.js'

//        'scripts/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
//        'scripts/demo/charts.helper.js',
//        'scripts/demo/charts.js',

//        'scripts/plugins/tables/DataTables/js/jquery.dataTables.min.js',
//        'scripts/plugins/tables/DataTables/js/DT_bootstrap.js',
//        'scripts/plugins/tables/DataTables/js/datatables.init.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jui\JuiAsset'
    ];

    public static function register($view) {
        $bundle=parent::register($view);
        $js = "
            var basePath = '".$bundle->baseUrl."/';
            var primaryColor = '#e25f39',
                dangerColor = '#bd362f',
                successColor = '#609450',
                warningColor = '#ab7a4b',
                inverseColor = '#45484d';
            var themerPrimaryColor = primaryColor;

        ";
        $view->registerJs($js, \yii\web\View::POS_END);

        return $bundle;
    }
}
