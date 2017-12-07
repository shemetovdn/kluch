<?php

namespace wbp\widgets;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;


class LimitedTextArea extends InputWidget
{

    public $limitContainerOptions=['style'=>'float:right;'];
    public $limitContainerText='You have %num% characters left.';
    public $limit=200;

    public function init()
    {
        $this->limitContainerText = Yii::t('admin','You have %num% characters left.');
        parent::init();

    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if ($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }

        $options = $this->options;
        $options['value'] = $value;
//        $options['id'] = $this->id;

        if ($this->hasModel()) {
            $contents[] = Html::activeTextarea($this->model, $this->attribute, $options);
        } else {
            $contents[] = Html::textarea($this->name, $value, $options);
        }

        $this->limitContainerOptions['id']=$this->options['id']."_limitContainer";

        $contents[] = Html::tag('div', null, $this->limitContainerOptions);

        $view = $this->getView();
        $view->registerJs("
            $('#".$this->options['id']."').bind('keyup keydown',function(){
                if ($(this).val().length > ".$this->limit.") {
                        $(this).val($(this).val().substring(0, ".$this->limit."));
                }
                $('#".$this->options['id']."_limitContainer').html(('".$this->limitContainerText."').replace('%num%', (".$this->limit."-$(this).val().length)));
            }).keyup();
        ");

        echo implode("\n",$contents);
    }


}
