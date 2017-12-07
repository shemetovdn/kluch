<?
    $this->registerJs("
        \$('".$selectName."').find('option').remove();
        \$('".$selectName."').append('<option value=\"0\">Please Select</option>');
    ",\yii\web\View::POS_END);

    foreach($regions as $region){
        $selected='';
        if($region->id==$stateSelected) $selected='selected';
        $this->registerJs("
            \$('".$selectName."').append('<option ".$selected." value=\"".$region->id."\">".addcslashes($region->title,"'")."</option>');
        ",\yii\web\View::POS_END);

    }