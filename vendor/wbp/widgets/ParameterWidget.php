<?php

namespace wbp\widgets;

use backend\modules\stores\models\Stores;
use yii\base\Widget;
use yii\helpers\Html;
use yii\jui\JuiAsset;
use yii\web\View;


class ParameterWidget extends Widget {

    public $formModel,$attribute,$itemTemplate;
    public $type='input';
    public $list=[];
    protected $id;
    /**
     * Initializes the widget.
     */
    public function init() {
        $this->id=uniqid('parametersWidget_');

        $this->itemTemplate= <<<EOF
            <div class="item">
                <div class="col-md-8">
                    %input%
                </div>
                <div class="col-md-1">
                    <span class="btn btn-block btn-inverse btn-icon btn-only-icon sortHandle glyphicons sorting"><i></i>&nbsp;</span>
                </div>
                <div class="col-md-1">
                    <span class="btn btn-block btn-danger btn-icon btn-only-icon removeButton glyphicons remove_2"><i></i>&nbsp;</span>
                </div>
                <div style="clear:both; height:7px;"></div>
            </div>
EOF;

        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerScripts();
        echo $this->renderWidget();
    }

    /**
     * render file input tag
     * @return string
     */
    private function renderWidget() {
        $items="";

        foreach((array)$this->formModel->{$this->attribute} as $num=>$prop) {
            if($this->type=='input'){
                $inputTemplate = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][value]', ['class' => 'form-control','value'=>$prop['value']]);
                $inputTemplate .= Html::activeHiddenInput($this->formModel, $this->attribute.'['.$num.'][id]', ['class' => 'form-control','value'=>$prop['id']]);
            }elseif($this->type=='select'){
                $inputTemplate = Html::activeDropDownList($this->formModel,$this->attribute.'['.$num.'][value]',$this->list,['class'=>'form-control','value'=>$prop['value']]);
                $inputTemplate .= Html::activeHiddenInput($this->formModel, $this->attribute.'['.$num.'][id]', ['class' => 'form-control','value'=>$prop['id']]);
            }
            $itemTemplate = str_replace("%input%",$inputTemplate,$this->itemTemplate);
            $items .=  str_replace(array("\n"),array(""),$itemTemplate);
//            $items .= str_replace(array("\n","%input%"),array("",$inputTemplate),$this->itemTemplate);
        }

        $result = <<<EOF
            <div id="{$this->id}">
                <div class="row">
                    <div class="sortable">
                        {$items}
                    </div>
                </div>
                <div class="separator bottom"></div>

                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <span class="btn btn-block btn-warning addOneButton">Add one</span>
                    </div>
                </div>
            </div>
EOF;

        return $result;
    }

    /**
     * register script
     */
    private function registerScripts() {
        $num=count($this->formModel->{$this->attribute});

        if($this->type=='input'){
            $inputTemplate = Html::activeTextInput($this->formModel,$this->attribute.'[%num%][value]',['class'=>'form-control']);
            $inputTemplate .= Html::activeHiddenInput($this->formModel, $this->attribute.'[%num%][id]', ['class' => 'form-control']);
        }elseif($this->type=='select'){
            $inputTemplate = Html::activeDropDownList($this->formModel,$this->attribute.'[%num%][value]',$this->list,['class'=>'form-control']);
            $inputTemplate .= Html::activeHiddenInput($this->formModel, $this->attribute.'[%num%][id]', ['class' => 'form-control']);
        }
        $itemTemplate = str_replace("%input%",$inputTemplate,$this->itemTemplate);
        $itemTemplate = str_replace(array("\n","\r\n","\r"),array("","",""),$itemTemplate);

        JuiAsset::register($this->view);

        $script = <<<EOF
            var num_{$this->id}={$num};
            $('#{$this->id} .addOneButton').click(function(){
                $('#{$this->id} .sortable').append(('{$itemTemplate}').replace(/%num%/g,num_{$this->id}));
                num_{$this->id}++;
            });

            $(document).on("click","#{$this->id} .removeButton",function(){
                var item=$(this).parents('.item');
                bootbox.confirm("Are you sure want to delete this item?", function(result){
                    if(result===true){
                        item.remove();
                    }
                });
            });

            $( "#{$this->id} .sortable" ).sortable({
              handle: ".sortHandle"
            });
EOF;
        $this->view->registerJs($script, View::POS_READY);
    }

}
