<?php
    namespace backend\modules\pages\models;

    use common\models\WbpActiveRecord;

    class PagesTopMenuSort extends WbpActiveRecord
    {

        public static function tableName()
        {
            return '{{%pages_top_menu_sort}}';
        }

        public function rules()
        {
            return [
                [['page_id','sort','language_id'],'safe'],
                [['page_id','sort','language_id'],'required']
            ];
        }


        public static function getTopMenuByLanguageID($id){
            $query = self::find()->select("page_id")->where(['language_id'=>$id])->orderBy('sort')->all();
            $result = [];
            if($query) {
                foreach ($query as $k => $v) {
                    $result[] = $v->page_id;
                }
            }
            if(count($result) == 0) $result[] = 0;
            return implode(",",$result);
        }
    }