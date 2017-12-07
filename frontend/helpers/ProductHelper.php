<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 29-Mar-17
 **** Time: 16:18
 */

namespace frontend\helpers;


use backend\modules\categories\models\Category;
use yii\helpers\Url;

class ProductHelper
{
    public static function urlToIndex()
    {
        $url = ['product/index', 'slug' => Category::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->one()->title];
        return Url::to($url);
    }
}