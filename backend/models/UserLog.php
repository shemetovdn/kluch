<?php

namespace backend\models;

use common\models\User;
use common\models\WbpActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_data}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserLog extends WbpActiveRecord
{

    const ACCESS_DENIED='ACCESS_DENIED';
    const SAVED='SAVED';
    const ADDED='ADDED';
    const REMOVED='DELETED';
    const SORTED='SORTED';

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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_log}}';
    }

    public function getIcon(){
        $icon='show_lines';
        if($this->additional_options==UserLog::ADDED) $icon='circle_plus';
        elseif($this->additional_options==UserLog::REMOVED) $icon='circle_remove';
        elseif($this->additional_options==UserLog::SAVED) $icon='edit';
        elseif($this->additional_options==UserLog::ACCESS_DENIED) $icon='ban';

        return $icon;
    }

    public function getMessage(){
        $user=User::findOne(['id'=>$this->user_id]);
        $moduleName=Modules::findOne(['name'=>$this->module])->title;
        if(!$moduleName) $moduleName=$this->module;
        $message="<a href='".Yii::$app->urlManager->createUrl(['employees/edit','id'=>$user->id])."'>".$user->name."</a> ";
        $module="<a href='".Yii::$app->urlManager->createUrl($this->module.'/index')."'>".Yii::t('admin',$moduleName)."</a> ";
        $item="<a href='".Yii::$app->urlManager->createUrl([$this->module.'/'.$this->action,'id'=>$this->item_id])."'>".Yii::t('admin','item')."</a> ";
        if(!$this->additional_options){
            $time=strtotime($this->updated_at)-strtotime($this->created_at);
            if($this->action=='edit' || $this->action=='add'){
                $message.=' '.Yii::t('admin',"trying to").' '.Yii::t('admin',$this->action).' ';
                if ($this->item_id) $message .= $item ." ".Yii::t('admin','in')." ";
                $message .= $module;
            }else{
                $message.=" ".Yii::t('admin',"viewed")." ".$module;
            }
            if($time) $message.=" ".Yii::t('admin','for')." ".Yii::$app->formatter->asHourMinutesSeconds($time);
        }elseif($this->additional_options==self::SAVED){
            $message.=' '.Yii::t('admin','edit').' ';
            if($this->item_id) $message.=$item." ".Yii::t('admin','in')." ";
            $message.=$module;
        }elseif($this->additional_options==self::ADDED){
            $message.=' '.Yii::t('admin','add').' ';
            if($this->item_id) $message.=$item.' in ';
            $message.=$module;
        }elseif($this->additional_options==self::REMOVED){
            $message.=' '.Yii::t('admin','remove').' ';
            if($this->item_id) $message.=Yii::t('admin','item #').$this->item_id." ".Yii::t('admin','in')." ";
            $message.=$module;
        }elseif($this->additional_options==self::ACCESS_DENIED){
            if($this->action=='edit' || $this->action=='add' || $this->action=='remove')
                $message.=' '.Yii::t('admin','trying to').' '.Yii::t('admin',$this->action).' ';
            else
                $message.=' '.Yii::t('admin','trying to access').' ';

            if($this->item_id) $message.=$item." ".Yii::t('admin','in')." ";
            $message.=$module.' '.Yii::t('admin','but ACCESS DENIED');
        }

        return $message;
    }

}
