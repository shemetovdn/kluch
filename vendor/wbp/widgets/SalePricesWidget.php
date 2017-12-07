<?php

namespace wbp\widgets;

use backend\modules\stores\models\Stores;
use yii\base\Widget;
use yii\helpers\Html;
use yii\jui\JuiAsset;
use yii\web\View;


class SalePricesWidget extends Widget {

    public $formModel,$attribute,$itemTemplate;
    protected $id;
    /**
     * Initializes the widget.
     */
    public function init() {
        $this->id=uniqid('parametersWidget_');

        $this->itemTemplate= <<<EOF
            <div class="item">
                <div class="col-md-5">
                    %input1%
                </div>
                <div class="col-md-2">
                    %input2%
                </div>
                <div class="col-md-2">
                    %input3%
                </div>
                <div class="col-md-1">
                    <span class="btn btn-block btn-danger btn-icon btn-only-icon removeButton glyphicons remove_2"><i></i>&nbsp;</span>
                </div>
                <div style="clear:both; height:7px;"></div>
                <div class="col-md-4">
                    %input4%
                </div>
                <div class="col-md-4">
                    %input5%
                </div>
                <div style="clear:both; height:14px;"></div>
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
            $inputTemplate1 = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][value]', ['class' => 'form-control','value'=>$prop['value'],'placeholder'=>'Enter price here...']);
            $inputTemplate1 .= Html::activeHiddenInput($this->formModel, $this->attribute.'['.$num.'][id]', ['class' => 'form-control','value'=>$prop['id']]);
            $inputTemplate2 = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][qty_start]', ['class' => 'form-control','value'=>$prop['qty_start'],'placeholder'=>'Start QTY']);
            $inputTemplate3 = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][qty_end]', ['class' => 'form-control','value'=>$prop['qty_end'],'placeholder'=>'End QTY']);
            $inputTemplate4 = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][start_date]', ['class' => 'form-control dateinput','value'=>$prop['start_date'],'placeholder'=>'Start date']);
            $inputTemplate5 = Html::activeTextInput($this->formModel, $this->attribute.'['.$num.'][stop_date]', ['class' => 'form-control dateinput','value'=>$prop['stop_date'],'placeholder'=>'Stop date']);
            $items .= str_replace(array("\n","%input1%","%input2%","%input3%","%input4%","%input5%"),array("",$inputTemplate1,$inputTemplate2,$inputTemplate3,$inputTemplate4,$inputTemplate5),$this->itemTemplate);
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
        $inputTemplate1 = Html::activeTextInput($this->formModel,$this->attribute.'[%num%][value]',['class'=>'form-control','placeholder'=>'Enter price here...']);
        $inputTemplate1 .= Html::activeHiddenInput($this->formModel, $this->attribute.'[%num%][id]', ['class' => 'form-control']);
        $inputTemplate2 = Html::activeTextInput($this->formModel,$this->attribute.'[%num%][qty_start]',['class'=>'form-control','placeholder'=>'Start QTY']);
        $inputTemplate3 = Html::activeTextInput($this->formModel,$this->attribute.'[%num%][qty_end]',['class'=>'form-control','placeholder'=>'End QTY']);

        $inputTemplate4 = Html::activeTextInput($this->formModel, $this->attribute.'[%num%][start_date]', ['class' => 'form-control dateinput','placeholder'=>'Start date']);
        $inputTemplate5 = Html::activeTextInput($this->formModel, $this->attribute.'[%num%][stop_date]', ['class' => 'form-control dateinput','placeholder'=>'Stop date']);
        $itemTemplate = str_replace(array("\n","%input1%","%input2%","%input3%","%input4%","%input5%"),array("",$inputTemplate1,$inputTemplate2,$inputTemplate3,$inputTemplate4,$inputTemplate5),$this->itemTemplate);

        JuiAsset::register($this->view);

        $script = <<<EOF
            var num_{$this->id}={$num};
            $('#{$this->id} .addOneButton').click(function(){
                $('#{$this->id} .sortable').append(('{$itemTemplate}').replace(/%num%/g,num_{$this->id}));
                $('#{$this->id} .dateinput').datepicker();
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
            
            $('#{$this->id} .dateinput').datepicker({"dateFormat":"yy-mm-dd"});

            $( "#{$this->id} .sortable" ).sortable({
              handle: ".sortHandle"
            });
EOF;
        $this->view->registerJs($script, View::POS_READY);


    }

}
