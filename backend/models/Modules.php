<?php

namespace backend\models;

use common\models\WbpActiveRecord;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class Modules extends WbpActiveRecord
{
    public function behaviors()
    {
        $behaviours=parent::behaviors();

        return ArrayHelper::merge($behaviours,[
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ]);
    }

    public static function tableName()
    {
        return '{{%modules}}';
    }

    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['id' => 'permission_id'])
            ->viaTable('{{%modules_permissions}}', ['module_id' => 'id']);
    }


    public function getNameClass(){
        $className = $this->class_name;
        if($className == ""){
            $className = 'backend\\modules\\'.$this->name.'\\Module';
        }

        return $className;
    }

    public function permissionExist($id){
        foreach($this->permissions as $perm){
            if($perm->id==$id) $permission=$perm;
        }
        if(!$permission) return false;
        return $permission;
    }

    public function getActiveStatusText($tag = 'span',$activeVerb = 'Active',$inactiveVerb = 'Disabled',$activeClass = 'text-success',$inactiveClass = 'text-danger',$style = 'font-weight:bold'){
        $cStatusText = $activeVerb;
        $cClass = $activeClass;
        if($this->status == 0){
            $cStatusText = $inactiveVerb;
            $cClass = $inactiveClass;
        }
        return Html::tag($tag,$cStatusText,['class'=>$cClass,'style'=>$style]);
    }

    public function getFilesStatus($text = 'Files in System: ',$textTag = 'strong',$successStatusClass = 'icon-check-sign text-success',$inactiveStatusClass = 'icon-remove-sign text-danger'){
        $cStatusClass=$successStatusClass;
        $check = true;

        //Check files in system

        //no such file
        if(!file_exists(Yii::getAlias('@serverDocumentRoot')."/".str_replace("\\","/",$this->nameClass.".php"))){
            $check = false;
        }
        //END  Check files in system

        if(!$check)$cStatusClass = $inactiveStatusClass;

        $cStatusElement = Html::tag('a','<i></i>',['class'=>'show_file_system '.$cStatusClass,'data-id'=>$this->id,'data-title'=>$this->title]);

        return Html::tag($textTag,$text.$cStatusElement);
    }

    public function getDBBaseStatus($text = 'DB in Table: ',$textTag = 'strong',$successStatusClass = 'icon-check-sign text-success',$inactiveStatusClass = 'icon-remove-sign text-danger'){
        return false;

        /*
         * TODO:
         * в будущем тянуть все необходимые таблицы с базы-сорца
         * через migrate исправлять (добавлять/изменять/удалять таблицы)
        */

        $cStatusClass=$successStatusClass;
        $check = true;

        //Check DB in system
        $controllorNamespace = Yii::$app->getModule('banners')->controllerNamespace;
        $controllorNamespacePath = Yii::getAlias('@serverDocumentRoot')."/".str_replace("\\","/",$controllorNamespace).DIRECTORY_SEPARATOR.".";
        $controllorNamespacePathSubfolders = FileTreeModel::getSubFolders($controllorNamespacePath,false);
        $c_array = [];
        if($controllorNamespacePathSubfolders['files']) {
            foreach ( $controllorNamespacePathSubfolders['files'] as $k => $v) {
                if(stristr($v,".php") && stristr($v,'Controller')){
                    $c_array[] = "".str_replace(".php","",$v);
                }
            }

            foreach($c_array as $k=>$v){
                try{
                    $controller = $controllorNamespace."\\".$v;
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            }
        }else{
            $check = false;
        }
        //END  Check DB in system

        if(!$check)$cStatusClass = $inactiveStatusClass;

        $cStatusElement = Html::tag('a','<i></i>',['class'=>'show_db_system '.$cStatusClass,'data-id'=>$this->id,'data-title'=>$this->title]);

        return Html::tag($textTag,$text.$cStatusElement);
    }
}
