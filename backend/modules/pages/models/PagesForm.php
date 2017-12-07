<?php
namespace backend\modules\pages\models;

use backend\models\BaseFormModel;
use backend\models\LanguageCompliance;
use Yii;

/**
 * Login form
 */
class PagesForm extends BaseFormModel
{
    public $modelName='backend\modules\pages\models\Pages';

    public $id,
        $title,
        $status,
        $href,
        $language_id,
        $parent_page,
        $content,
//        $seo_title,$seo_keywords,$seo_h1,$seo_description,
//        $is_top_menu,
        $widget_id,
        $in_lang,
//        $is_middle_menu,
//        $is_footer_menu,
        $banner_title,
        $short_description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['widget_id','title','status','language_id','parent_page','content', /*'seo_title','seo_keywords','seo_h1','seo_description','is_footer_menu','is_middle_menu','is_top_menu',*/'in_lang','banner_title','short_description'],'safe','on'=>['edit','add']],
            [['href'],'safe'],
            [['title'],'required']
        ];
    }

    public function afterLoadModel(){
        $model=$this->findModel();
        $this->href=$model->href;
        foreach($model->contents as $content) {
            $this->content[] = $content->content;
        }
        foreach($model->widgets as $widget){
            $this->widget_id[] = $widget->widget_id;
        }

        //LanguageCompliance
        $in_lang_items = LanguageCompliance::find()->where(['page_id'=>$this->id])->andWhere(['module'=>$this->modelName])->asArray()->all();
        foreach($in_lang_items as $in_lang_item){
            $modelName = $this->modelName;
            $page_lang = $modelName::find()->
                                select('language_id')->
                                where(['id'=>$in_lang_item[pageaset_id]])->
                                asArray()->one();
            $this->in_lang[$page_lang['language_id']] = $in_lang_item[pageaset_id];
        }
        //LanguageCompliance END

    }

    public function attributeLabels(){
        return [
            'title'=>'Title',
            'language_id'=>'Language',
            'status' => Yii::t('admin','status'),
            'parent_page' => Yii::t('admin','parent page'),
            'is_middle_menu' => Yii::t('admin','is middle menu page'),
            'is_footer_menu' => Yii::t('admin','is footer menu page'),
            'is_top_menu' => Yii::t('admin','is top menu')
        ];
    }

    public  function afterSave(){
        $model=$this->findModel();
        foreach($model->contents as $content) $content->delete();

        if(is_array($this->content)) {
            foreach ($this->content as $content) {
                $C_content = new PagesContent();
                $C_content->content = $content;
                $C_content->page_id = $model->id;
                $C_content->save();
            }
        }

        //WIDGETs
        $w_list = [];
        if(is_array($this->widget_id)){
            foreach($this->widget_id as $widget_id) {
                $Wid = SiteWidgetsAvailableRelation::findOne(['page_id' => $model->id,'widget_id'=>$widget_id]);
                if (!$Wid) {
                    $Wid = new SiteWidgetsAvailableRelation();
                }
                $Wid->page_id = $model->id;
                $Wid->widget_id = $widget_id;
                $Wid->save();
                $w_list[] = $widget_id;
            }

        }
        $dels = SiteWidgetsAvailableRelation::find()->where(['not in', 'widget_id', $w_list])->andWhere(['page_id' => $model->id])->all();
        foreach ($dels as $del) {
            $del->delete();
        }

        //LanguageCompliance
        $ToDelete = LanguageCompliance::find()->where(['module'=>$this->modelName,'page_id'=>$this->id])
            ->orWhere(['module'=>$this->modelName,'pageaset_id'=>$this->id])->all();
        foreach($ToDelete as $item){
            $item->delete();
        }

        foreach((array)$this->in_lang as $lang=>$page_in_lang){
            if($page_in_lang != 0){

                $lang_item = new LanguageCompliance();
                $lang_item->page_id = $this->id;
                $lang_item->pageaset_id = $page_in_lang;
                $lang_item->module = $this->modelName;
                $lang_item->save();

                $lang_item_rev = new LanguageCompliance();
                $lang_item_rev->page_id = $page_in_lang;
                $lang_item_rev->pageaset_id = $this->id;
                $lang_item_rev->module = $this->modelName;
                $lang_item_rev->save();
            }
        }
        //LanguageCompliance END


    }




}
