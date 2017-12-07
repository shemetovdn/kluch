<?php
namespace backend\modules\pages\models;

use backend\models\Languages;
use common\models\WbpActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Pages extends WbpActiveRecord
{

    public static $imageTypes = ['Pages'];

    public static $seoKey='page';

    public static function tableName()
    {
        return '{{%pages}}';
    }
    public static function findByHref($href){
        return self::find()->where(['href'=>$href])->andWhere(['status'=>1]);
    }

    public function behaviors()
    {
        $behaviours = parent::behaviors();

        return ArrayHelper::merge($behaviours, [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ]);
    }

    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    public function getContents()
    {
        return $this->hasMany(PagesContent::className(), ['page_id' => 'id'])->orderBy("id");
    }

    public function getWidgets()
    {
        return $this->hasMany(SiteWidgetsAvailableRelation::className(), ['page_id' => 'id'])->orderBy('sort');
    }

    public function getChilds($andWhere = []){
        return $this->hasMany(Pages::className(), ['parent_page' => 'id'])->andWhere(['status'=>1])->andWhere($andWhere);
    }

    public function getUrl(){
        return Url::to(['site/'.$this->href]);
    }

    public static function getHierarchy($id = 0)
    {
        $result = [];
        $items = self::find()->where(['parent_page' => $id])->asArray()->all();
        foreach ($items as $item) {
            $result[$item['id']] = $item['title'];
        }
        return $result;
    }


}