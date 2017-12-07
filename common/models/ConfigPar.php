<?php
    namespace common\models;

//    use common\models\Category;

    class ConfigPar extends WbpActiveRecord
    {
        public static $imageTypes=[];

        public static function tableName()
        {
            return '{{%config}}';
        }

    }