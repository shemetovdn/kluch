<?php
namespace backend\widgets;

use backend\models\Languages;
use wbp\ClassNameGetter\ClassNameGetter;
use Yii;
use yii\base\Widget;

class LanguageCompliance extends Widget
{

    public $model;

    public $form;

    public $fieldName = 'language_id';

    public $containerId;

    public $marking = [
        'separator_top' => true,
        'separator_bottom' => false,
        'greed_left_block' => 'col-md-4',
        'greed_right_block' => 'col-md-8',
    ];

    public function init()
    {
        parent::init();

        $this->containerId = 'LanguageComplianceContainer'.$this->id;

    }

    public function run()
    {
        $select = [];
        $lang_id = Yii::$app->request->get()['lang_id'];


        $model = Yii::$app->controller->ModelName;
        $LanguagesLists = Languages::find()->where(['<>','id',$lang_id])->andWhere(['status'=>1])->asArray()->all();
        foreach ($LanguagesLists as $LanguagesItem){

            $listModelItems = $model::find()->where(['language_id'=>$LanguagesItem['id']])->asArray()->all();

            $listItems = [];
            $listItems[] = 'None selected';
            foreach($listModelItems as $item){
                $listItems[$item['id']] = $item['title'];
            }
            $select[] = $this->form->field($this->model,'in_lang['.$LanguagesItem['id'].']',[
                'options'=>[
                    'class'=>''
                ]
            ])->label('In Language '.$LanguagesItem['title'])->dropDownList($listItems);

        }
        return $this->render('LanguageCompliance',[
            'select'=>$select,
            'fieldName'=>ClassNameGetter::getClassname($this->model,false).'-'.$this->fieldName,
            'containerId'=>$this->containerId,
            'lang_id'=>$lang_id,
            'marking'=>$this->marking
        ]);
    }

}