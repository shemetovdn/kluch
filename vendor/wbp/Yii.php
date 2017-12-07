<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 01.02.2016
 **** Time: 17:06
 *
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var WebApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/../../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \wbp\eStoreApi\eStore $eStore
 * @property \wbp\eStoreApi\eStoreCart $eStoreCart
 * @property \wbp\lang\Lang $lang
 */

class WebApplication extends yii\web\Application
{
}
