<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 12.02.2016
 * Time: 14:57
 */
?>
<div class="widget-head">
    <h4 class="heading glyphicons edit"><i></i>Available Placeholders</h4>
</div>

<div class="widget-body">
    <?if(Yii::$app->user->identity->is_super_admin == 1){?>
        <div class="adminAddedPlaceholderBlock">
            <select name="placeholdersAdd" class="form-control">
                <option value="0">Please select</option>
                <option value="-1">Create new</option>
                <?foreach($notCheckedPlaceholders as $k=>$v){
                    echo '<option value="'.$k.'">'.$v.'</option>';
                }?>
            </select>
            <button type="button" class="btn btn-primary addPlaceholder"></button>
        </div>
        <div style="clear:both"></div>
    <?}?>
    <pre>
            <?if(!$placeholders){
                echo '<b style="text-align: center;display: block;">No avaliable placeholders</b>';
            }else{
                echo '<div style="clear:both"></div>';
                foreach($placeholders as $placeholder){
                    $adder = '';
                    if(Yii::$app->user->identity->is_super_admin  == 1)$adder = '<span class="delete_placeholder" data-id="'.$placeholder->id.'">x</span>';
                    echo '<b>'.$placeholder->placeholder.'</b> - '.$placeholder->description.$adder."<br/>";
                }
            }?>
        </pre>
</div>


