<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 04.09.2015
 **** Time: 11:30
 */

namespace wbp\widgets;


use yii\bootstrap\Widget;

class GridInput extends Widget
{
    public static function help($input, $title, $hint, $length_left, $length_right, $clear_after_block=false)
    {
        $output = '';
        $body = '';
        $left_col = '';
        $right_col = '';
        $clear = '<div class="clearfix"></div>';
        if($length_left || $length_right){
            $left_col = (int)$length_left;
            $right_col = (int)$length_right;
        }
        if(is_array($input)){
            foreach($input as $v){
                $output .= $v;
            }

        }else{
            $output = $input;
        }

        $body .= <<<HERE
        <div class="row">
            <div class="col-lg-$left_col col-md-$left_col col-xs-$left_col">
                <strong>$title</strong>
                <p class="muted">$hint</p>
            </div>
            <div class="col-lg-$right_col col-md-$right_col col-xs-$right_col">
                $output
            </div>
        </div>
HERE;
        if($clear_after_block){
            $body .= $clear;
        }
        return $body;
    }

}