<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 25.02.2016
 * Time: 14:27
 */
namespace wbp\PrettyAlert;

use common\models\Config;
use kartik\growl\Growl;
use yii\base\Exception;
use yii\base\Widget;
use yii\helpers\Html;

class Alert extends Widget{

    public $allowedtypes = [Growl::TYPE_SUCCESS,Growl::TYPE_INFO,Growl::TYPE_WARNING,Growl::TYPE_DANGER, Growl::TYPE_GROWL,Growl::TYPE_MINIMALIST,Growl::TYPE_PASTEL,Growl::TYPE_CUSTOM,];
    public $typesIco = ['glyphicon-ok-sign','glyphicon-info-sign','glyphicon-exclamation-sign','glyphicon-remove-sign'];//TODO: ico for Growl::TYPE_GROWL,Growl::TYPE_MINIMALIST,Growl::TYPE_PASTEL
    public $type = Growl::TYPE_INFO;
    public $alertShowSeparator = true;
    public $alertDelay = 200;
    public $alertShowProgressbar = true;
    public $alertShowingOption = ['from' => 'top', 'align' => 'right'];
    public $autoSearchInSession = false;
    public $title,$alertIco,$message;


    /*
     * checking for errors on init
     */

    public function init()
    {
        if(!class_exists('kartik\\growl\\Growl')){
            die('Use the file <i>"'.__FILE__.'"</i> <p style="color:red">impossible</p> Please install kartik\growl\Growl ->$ <b>php composer.phar require kartik-v/yii2-widget-growl "*" </b>');
        }

        parent::init();
    }

    /*
     * Check alowed ico and set ico
     * if not is set
     */
    protected function checkType($type){
        if(!in_array($this->type, $this->allowedtypes)){
            throw new Exception("Alert Type can be only [".implode(",",$this->allowedtypes)."]. You choose '".$this->type."'");
        }
        if(!$this->alertIco){
            $icoIndex = array_search($type,$this->allowedtypes);
            if(array_search($icoIndex,array_keys($this->typesIco)) !== false) {
                return "glyphicon " . $this->typesIco[$icoIndex];
            }else{
                return "glyphicon ".$this->typesIco[0];
            }
        }
    }


    protected function checkInSession(){
        $errors = \Yii::$app->session->getAllFlashes();
        if(count($errors)> 0){
            foreach ($errors as $type => $message) {
                $type = trim(mb_strtolower($type));
                $this->callAlertDialog($message,$type);
            }
        }
    }

    protected function callAlertDialog($message = '',$type = '',$title = '',$ico = '',$separator = '',$delay = '',$showProressBar = '',$placement = ''){
        $type = $this->allowedApproximateness($type);
        if(!$type)$type = $this->type;
        if(!$title)$title = Config::getParameter("title");
        $title = Html::tag("span",$title,['style'=>"text-align: center;display:block;margin-top: -20px;"]);
        if(!$message)$message = $this->message;
        if(!$separator)$separator = $this->alertShowSeparator;
        if(!$delay)$delay = $this->alertDelay;
        if(!$showProressBar)$showProressBar = $this->alertShowProgressbar;
        if(!$placement)$placement = $this->alertShowingOption;
        if(!$ico)$ico = $this->checkType($type);

        return Growl::widget([
            'type' => $type,
            'title' => $title,
            'icon' => $ico,
            'body' => $message,
            'showSeparator' => $separator,
            'delay' => $delay,
            'pluginOptions' => [
                'showProgressbar' => $showProressBar,
                'placement' =>$placement,
            ]
        ]);
    }

    protected function allowedApproximateness($type = ''){
        if($type != "")$this->type = $type;
        if($this->type == 'error') return $this->type = 'danger';
        if($this->type == 'ok') return $this->type = 'success';
        return $type;
    }

    public function run(){
        if($this->autoSearchInSession === true){
            $this->checkInSession();
        }elseif($this->message != "" && $this->type){
            $this->callAlertDialog();
        }
    }
}
