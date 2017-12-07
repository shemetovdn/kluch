<?php

namespace backend\modules\products\helper;
use backend\modules\products\models\Product;

/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 27-Mar-17
 **** Time: 14:18
 */
class ProductsHelper
{
    public static function hasParentTitle( Product $product)
    {
        return ($product->parent == null) ? '' : $product->parent->title;
    }
}