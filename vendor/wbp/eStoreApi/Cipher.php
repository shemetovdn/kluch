<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 08.02.2016
 * Time: 16:40
 */
namespace wbp\eStoreApi;

use nickcv\encrypter\components\Encrypter;
use yii\base\ErrorException;

class Cipher extends Encrypter{

    const transferPassword = ']+x!^U"pw9=#bn)6!YXth0$mc';
    const transferIv = '[LBcS)a7G8qY*Kpy';
    const transferUseBase64Encoding = true;
    const transferUse256BitesEncoding = true;


    public function init()
    {
        $this->setRealEncoding();
        parent::init();
    }

    public function setTransferEncoding(){
        $this->setGlobalPassword(self::transferPassword);
        $this->setIv(self::transferIv);
        $this->setUse256BitesEncoding(self::transferUseBase64Encoding);
        $this->setUseBase64Encoding(self::transferUse256BitesEncoding);
    }

    protected function setRealEncoding(){
        $data = \Yii::$app->eStore->get('cipher/params');
        if($data['password'] && $data['iv'] && $data['use256BitesEncoding'] && $data['useBase64Encoding']) {
            $this->setTransferEncoding();
            $currentGlobalPassword = $this->decrypt($data['password']);
            $currentIv = $this->decrypt($data['iv']);
            $currentUse256BitesEncoding = $this->decrypt($data['use256BitesEncoding']);
            $currentUseBase64Encoding = $this->decrypt($data['useBase64Encoding']);
            if($currentGlobalPassword !== false && $currentIv !== false){
                $this->setGlobalPassword($currentGlobalPassword);
                $this->setIv($currentIv);
                $this->setUse256BitesEncoding((bool)$currentUse256BitesEncoding);
                $this->setUseBase64Encoding((bool)$currentUseBase64Encoding);
            }else{
                throw new ErrorException("Can't decrypt parameters for real encryption");
            }
        }else{
            throw new ErrorException("Haven't correct data for starting encrypt component");
        }
    }
}