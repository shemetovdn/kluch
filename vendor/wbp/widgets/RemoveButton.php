<?php

namespace wbp\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;


/**
 * Uploadify Widget
 *
 */
class RemoveButton extends Widget {

    public $linkOptions;
    public $ajax=true;
    protected $id;
    /**
     * Initializes the widget.
     */
    public function init() {
        $this->id=uniqid('removeButton_');

        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerScripts();
        echo $this->renderLink();
    }


    /**
     * render file input tag
     * @return string
     */
    private function renderLink() {
        $result=Html::a($this->linkOptions['text'],$this->linkOptions['url'],ArrayHelper::merge($this->linkOptions['options'],['id'=>$this->id,'data-pjax'=>0]));
        return $result;
    }

    /**
     * register script
     */
    private function registerScripts() {
        $script = <<<EOF
            $('#{$this->id}').click(function(e){
                e.preventDefault();
                var thisObj=$(this);
                swal({
                    title: "Вы серьезно?",
                    text: "Вы действительно хотите удалить этот элемент?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Да, удалить его",
                    cancelButtonText: "Отмена",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
EOF;
                    if($this->ajax)
                        $script .= <<<EOF
                            $.post(thisObj.attr('href'),function(data){
                                swal({
                                    title: "Удален!",
                                    text: "Ваш поразительный объект удален.",
                                    type: "success",
                                    confirmButtonClass: "btn-success"
                                });
                                $('.pjax-container').each(function(){
                                    $.pjax.reload({container:"#"+$(this).attr('id')});
                                });
                            });
EOF;
                    else
                        $script .= <<<EOF
                            document.location.href=thisObj.attr('href');
EOF;
                        $script .= <<<EOF
                    } else {
                        swal({
                            title: "Отмена",
                            text: "Ваш поразительный объект сохранен :)",
                            type: "error",
                            confirmButtonClass: "btn-danger"
                        });
                    }
                });

                return false;
            });
EOF;
        $this->view->registerJs($script, View::POS_END);
    }

}
