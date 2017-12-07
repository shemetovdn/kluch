<?php

namespace wbp\images\widgets;

use kartik\tabs\TabsX;
use wbp\images\models\ImageSizes;
use wbp\images\ModuleTrait;
use Yii;
use wbp\uploadifive\Uploadifive;
use yii\jui\Tabs;
use yii\web\View;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Uploadify Widget
 *
 */
class ImageCroper extends Widget {

    use ModuleTrait;

    public $type='';
    public $itemId=0;
    public $imageId=0;
    public $afterSave;

    public function run(){
        $return='';

        $sizes=ImageSizes::find()->where([
            'type'=>$this->type,
            'status'=>1
        ])->all();

        $items=[];
        foreach ($sizes as $num=>$size){

            $this->addAccess($size->id);

            $items[]=[
                'label'=>$size->title,
                'linkOptions'=>['data-enable-cache'=>'', 'style'=>'padding: 0 15px;', 'data-url'=>Url::to([$this->getModule()->id.'/crop/size', 'widget_id'=>$this->id ,'id'=>$size->id,'type'=>$this->type,'itemId'=>$this->itemId,'imageId'=>$this->imageId])],
                'active' => ($num==0) ? true : false,
            ];
        }

        $tab_x_id=uniqid('tab_x_');
        $return.=TabsX::widget([
            'id'=>$tab_x_id,
            'items'=>$items,
        ]);

        $this->view->registerJs(' $("[href=\'#'.$tab_x_id.'-tab0\']").click();',View::POS_READY);
        $this->view->registerJs('var success_'.$this->id.' = '.$this->afterSave.' ',View::POS_END);

        return $return;
    }

    public function addAccess($size){
        $cropAccess=Yii::$app->session->get('cropAccess');
        if(!$cropAccess) $cropAccess=[];
        $cropAccess[]=[
            'type'=>$this->type,
            'itemId'=>$this->itemId,
            'size'=>$size
        ];
        Yii::$app->session->set('cropAccess',$cropAccess);
    }

}
