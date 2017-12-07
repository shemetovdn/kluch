<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 04.09.2015
 * Time: 11:26
 */
namespace backend\models;

use yii\base\ErrorException;
use yii\base\Model;
use yii\helpers\Html;

class FileTreeModel extends Model{

    public static function getSubFolders($path='',$prettyTreeOutput = true){

        $tree = [];
        $p_info = pathinfo($path, PATHINFO_DIRNAME);

        if (!is_dir($p_info)) {
            $tree['error'] = 'There is no such folder &quot;<b><i>' . $path . '</i></b>&quot; at all';
        } else {
            try {
                $scanDir = scandir($p_info);
                $scanned_path = array_diff($scanDir, array('..', '.'));
                foreach ($scanned_path as $k => $v) {
                    $vF = $p_info . "/" . $v;
                    if (is_dir($vF)) {
                        $tree['folders'][$v][] = FileTreeModel::getSubFolders($vF . DIRECTORY_SEPARATOR . ".", false);
                    } else {
                        $tree['files'][] = $v;
                    }
                }
                if ($prettyTreeOutput === true) {
                    $tree = self::prettyTreeOutput($tree);
                }
            } catch (ErrorException $e) {
                $tree['error'] = 'Can not scan directory <strong>"' . $p_info . '"</strong>. <i>Reason:</i> ' . $e->getMessage();
            }
        }

        return $tree;
    }


    public  static function prettyTreeOutput($values,$i = 0,$repeatTimes = 5,$repeatSymbol = '&nbsp;',$folderTag='strong'){
        $content = '';
        if(is_array($values) ){
            //folders always first
            foreach($values as $k=>$v){
                if($k == 'folders'){
                    $i++;
                    foreach($v as $kk=>$vv){
                        foreach($vv as $kkk=>$vvv){
                            $content .= "<br/>".str_repeat($repeatSymbol,$i*$repeatTimes).
                                        Html::tag($folderTag,
                                            Html::tag("i",'',
                                                ['class'=>'icon-folder-open']).
                                            $kk,
                                            ['style'=>'font-size:20px;']).
                                        FileTreeModel::prettyTreeOutput($vvv,$i);
                        }
                    }
                }
            }

            //files after folders
            foreach($values as $k=>$v) {
                if ($k == 'files') {
                    $i++;
                    foreach ($v as $vv) {
                        $file_ext =  explode('.',$vv);
                        $file_ext_ = count($file_ext)-1;
                        $sh_ext = $file_ext[$file_ext_];
                        $content .=  "<br/>".str_repeat($repeatSymbol, $i * $repeatTimes) .
                            Html::tag("span",
                                Html::tag("i",'').
                                $vv,['class'=>'glyphicons-filetype '.$sh_ext,'style'=>'font-size:18px;line-height: 30px;']);
                    }
                }
            }
        }
        return $content;
    }
}