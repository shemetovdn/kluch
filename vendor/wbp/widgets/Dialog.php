<?php

namespace wbp\widgets;



class Dialog extends \yii\jui\Dialog{
    public function buttons($buttons)
    {
        if ($id === null) {
            $id = $this->options['id'];
        }
        $js = "jQuery('#$id').dialog('option', 'buttons', ".$buttons.");";
        $this->getView()->registerJs($js);
    }
}