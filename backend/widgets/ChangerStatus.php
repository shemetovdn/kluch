<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 16.11.2015
 **** Time: 15:54
 */

namespace backend\widgets;

use backend\models\Status;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\web\View;

class ChangerStatus extends Widget
{

    public $id;
    public $className;
    public $title;
    public $action;
    public $field;
    public $classes;

    private $uniq;


    private static $eyes = [
        Status::ENABLE => 'icmn-eye',
        Status::DISABLED => 'icmn-eye-blocked',
    ];


    public function init()
    {
        $this->uniq = uniqid('ajax_');
        parent::init();
    }


    public function run()
    {
        parent::run();
        $this->classes = $this->changeStatus($this->id, $this->field, $this->className);

        return $this->generate();
    }


    public function generate()
    {

        $script = <<<AAA
            $(".{$this->uniq}").on("click", function(){
                var thisObj = $(this);
                $.post( thisObj.attr('href') , function(result){
                    console.debug(result);
                    if(result){
                        if(thisObj.find('i').hasClass('icmn-eye')){
                            thisObj.find('i').removeClass('icmn-eye').addClass('icmn-eye-blocked');
                        }else{
                            thisObj.find('i').removeClass('icmn-eye-blocked').addClass('icmn-eye');
                        }
                    }
                });
                return false;
            });
AAA;

        $this->view->registerJs($script, View::POS_END);
        return Html::a('<i class="'.$this->classes.'"></i>', $this->action, ['class' => $this->uniq.' btn-info btn ', 'title' => $this->title]);
    }



    protected function changeStatus($id, $field, $obj)
    {
        $model = $obj::findOne($id);
        return self::$eyes[$model->{$field}];
    }



}