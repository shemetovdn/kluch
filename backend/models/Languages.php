<?php
    namespace backend\models;

    use common\models\WbpActiveRecord;

    class Languages extends WbpActiveRecord
    {

        public static function currentId(){
            return self::find()->where(['lang_full_key'=>\Yii::$app->language])->one()->id;
        }

        public static function getLanguage(){
            return self::findOne(['id'=>self::currentId()]);
        }

        public static function getAvailiableLanguage(){
            return self::find()->where(['<>','id',self::currentId()])->andWhere(['status'=>1])->all();
        }

        public static function tableName()
        {
            return '{{%languages}}';
        }

        public function fields(){
            return [
                'id',
                'title',
                'sort'
            ];
        }

    }