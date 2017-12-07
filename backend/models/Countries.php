<?php
    namespace backend\models;

    use common\models\WbpActiveRecord;

    class Countries extends WbpActiveRecord
    {

        public static function find()
        {
            return new StatusQuery(get_called_class());
        }

        public static function tableName()
        {
            return '{{%country}}';
        }

        public function fields(){
            return [
                'id',
                'title',
                'code',
                'sort'
            ];
        }
        public function extraFields()
        {
            return ['regions'];
        }

        public function checkAccess($store_id){
            return true;
        }

        public function getRegions(){
            return $this->hasMany(Regions::className(), ['country_id' => 'id'])->orderBy('title');
        }

        public function __toString(){
            return $this->title;
        }

    }