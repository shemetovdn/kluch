<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\multipleCountrySelector;

use yii\web\AssetBundle;
use yii\web\View;


/**
 * This asset bundle provides multiple selector
 *
 * @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */
class multipleCountrySelectorAsset extends AssetBundle
{
    public $sourcePath = '@wbp/multipleCountrySelector/files';
    public $js = [
        'multipleCountrySelector.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function register($view)
    {
        $bundle=parent::register($view);

        $view->registerJs('
            getGlobalCountries(\''.$bundle->baseUrl.'\')
        ',View::POS_END);

        return $bundle;
    }

}
