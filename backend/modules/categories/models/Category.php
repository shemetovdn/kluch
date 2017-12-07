<?php
namespace backend\modules\categories\models;

use backend\modules\channels\models\Channels;
use backend\modules\products\models\Product;
use common\models\WbpActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class Category extends WbpActiveRecord
{
    public static $seoKey = 'category';
    public static $imageTypes = ['category'];

    public static function tableName()
    {
        return '{{%categories}}';
    }

    public function rules()
    {
        return [
            [['title', 'href', 'status'], 'safe', 'on' => [self::ADMIN_ADD_SCENARIO, self::ADMIN_EDIT_SCENARIO]],
        ];
    }

    public function getUrl($absolute = false)
    {
        return Url::to(['catalog/'.$this->href]);
    }

    public function getLink()
    {
        return [
            'product/index',
            'slug' => $this->title
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }


    public function getRootProductsDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Product::find()->where([
                'status' => 1,
                'category_id' => $this->id,
                'parent' => 0,
            ])
                ->orderBy(['sort' => SORT_ASC])
        ]);
    }
}