<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 13.11.2015
 **** Time: 12:35
 */

namespace backend\modules\orderPropertyManagment\models;

use common\models\Config;
use common\models\WbpActiveRecord;

class OrderPropertyManagmentAnswers extends WbpActiveRecord
{
    public static function tableName()
    {
        return '{{%contact_answer}}';
    }


    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this,'sendMail']);
        parent::init(); // TODO: Change the autogenerated stub
    }


    public function rules()
    {
        return [
            [['contact_id', 'answer' ], 'required'],
            [['answer'], 'safe'],
            ['contact_id', 'integer'],
            ['answer', 'string']
        ];
    }



    public function getContact()
    {
        return $this->hasOne(OrderPropertyManagment::className(), ['id' => 'contact_id']);
    }

    public function sendMail(){
        \Yii::$app->mailer->compose(['text'])
            ->setFrom([Config::getParameter('email') => Config::getParameter('title')])
            ->setTo([$this->contact->email => $this->contact->fname . ' ' . $this->contact->lname])
            ->setSubject('Re: ' . $this->contact->inquiry)
            ->setCharset('UTF-8')
            ->setTextBody("\r\n".$this->answer)
            ->send();
    }



}