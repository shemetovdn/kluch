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

class AvailableParameterImages extends Widget
{
    public $parameter;

    public function run()
    {
        $this->registerScript();

        echo $this->render('images',[
            'id'=>$this->id,
            'name'=>strtolower($this->parameter->title),
            'title'=>$this->parameter->title,
            'parameters'=>$this->parameter->options
        ]);
    }

    public function registerScript(){
        $name=strtolower($this->parameter->title);
        $script=<<<JS

            $("#{$this->id} .color-choose").click(function(){
                if($(this).hasClass('disabled')) return false;
                $("#{$this->id} .color-choose").removeClass('selected');
                $(this).addClass('selected');
                $(this).parents('.colorsWidget').find("input[name={$name}]").val($(this).data('val'));
                $(this).parents('.colorsWidget').find("input[name^=products]").val($(this).data('products'));

                disableWronsParams();

            });




JS;

        $this->view->registerJs($script, View::POS_END);
    }

}