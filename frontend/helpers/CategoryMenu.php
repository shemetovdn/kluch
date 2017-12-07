<?php

namespace frontend\helpers;
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 27-Mar-17
 **** Time: 14:47
 */
class CategoryMenu
{
    public static function getItems()
    {
        $categories = \backend\modules\categories\models\Category::find()->where(['status' => 1])->all();
        $result = [];
        foreach ($categories as $category) {
            $result[] = [
                    'label' => \Yii::t('app', $category->title),
                    'url' => $category->link
                ];
        }
        return $result;

    }
}