<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2/1/2016
 * Time: 13:35
 */

namespace wbp\eStoreApi\widgets\AvailableParameters;


use yii\base\Widget;
use yii\web\View;

class AvailableParameterSelect extends Widget
{
    public $parameter;

    public function run()
    {
        $this->registerScript();

        echo $this->render('select',[
            'id'=>$this->id,
            'name'=>strtolower($this->parameter->title),
            'title'=>$this->parameter->title,
            'parameters'=>$this->parameter->options
        ]);
    }

    public function registerScript(){
        $script=<<<JS

            $("#{$this->id} select").change(function(){
                $(this).parents('.selectWidget').find("input[name^=products]").val($(this).find('option[value="'+$(this).val()+'"]').data('products'));

                disableWronsParams();

            });


JS;

        $this->view->registerJs($script, View::POS_END);
    }


}