<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 09.01.2015
 * Time: 11:36
 */

namespace backend\models;

use common\models\Category;

class MenuModel extends \yii\base\Model{
    public static function getItems(){
        $menuItems = [
            ['label' => 'меню', 'url' => ['/products/default/all']],
            ['label' => 'категории', 'url' => ['/category/default/index']],
            ['label' => 'бизнес ланч', 'url' => ['/lunch/default/index']],
            ['label' => 'бонусы', 'url' => ['/pages/default/edit','id'=>1]],
            ['label' => 'блог', 'url' => ['/blog/default/index']],
            ['label' => 'акции', 'url' => ['/promo/default/index']],
            ['label' => 'главная', 'url' => ['/pages/default/editindex','id'=>10]],
            ['label' => 'доставка', 'url' => ['/pages/default/edit','id'=>2]],
            ['label' => 'контакты', 'url' => ['/pages/default/edit','id'=>3]],
            ['label' => 'о нас', 'url' => ['/pages/default/edit','id'=>4]],
            ['label' => 'камеры', 'url' => ['/pages/default/edit','id'=>5]],
            ['label' => 'вакансии', 'url' => ['/pages/default/edit','id'=>6]],
            ['label' => 'партнерам', 'url' => ['/pages/default/edit','id'=>7]],
            ['label' => 'отзывы о работе', 'url' => ['/testimonials/default/index']],
            ['label' => 'отзывы о блюдах', 'url' => ['/testimonials/default/menu']],
            ['label' => 'метки', 'url' => ['/flags/default/index']],
        ];

        $categories=Category::find()
            ->where(['status'=>Category::STATUS_ACTIVE])->orderBy('sort, id desc');

        foreach($categories->each() as $num=>$category){
            $menuItems[1]['items'][]=['label' => mb_strtolower($category->title), 'url' => ['/products/default/category','id'=>$category->id]];
        }
        foreach($menuItems as $num=>$item){
            if(\Yii::$app->controller->action->id=='category' && \Yii::$app->controller->module->id=='products') continue;
            if(\Yii::$app->controller->module->id=='testimonials') continue;
            if(\Yii::$app->controller->module->id=='pages') continue;
            if(strpos($item['url'][0],\Yii::$app->controller->module->id)!==false){
                $menuItems[$num]['active']=true;
            }
        }

        return $menuItems;
    }
}
