<?php

namespace wbp\Popup;


use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: Леха
 * Date: 05.07.2016
 * Time: 16:18
 */
class CustomPopup extends Widget
{
    const CUSTOM_POPUP_TYPE = 'custom-popup';
    public $customPopup;
    
    
    public function init()
    {
        $this->customPopup = \Yii::$app->session->get(self::CUSTOM_POPUP_TYPE);
    }
    
    public function run()
    {
        if(isset($this->customPopup)) {

            \Yii::$app->session->remove(self::CUSTOM_POPUP_TYPE);
            return $this->render('custom-popup', ['model' => $this->customPopup ]);
        }
    }


}