<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 09.02.2016
 * Time: 10:06
 */

namespace wbp\cipher;

use nickcv\encrypter\components\Encrypter;

class Cipher extends Encrypter{
    /*Crypted on whole site*/
    const password = '5D]p#5Dw!*5>"\DDRJ[n}@|@uAf^A^Qez+5J;)^`?#+{I};%Q9@"$\0g\QDNqy*i:BwEzhsf@Lk^?IW;v[3eI[s$T4K>pRc|mD+X';
    const iv = 'Z3`zId>2a^ecsLPf';
    const useBase64Encoding = true;
    const use256BitesEncoding = true;
    /*END Crypted on whole site*/

    /*Transfered Keys - same as on client*/
    const transferPassword = ']+x!^U"pw9=#bn)6!YXth0$mc';
    const transferIv = '[LBcS)a7G8qY*Kpy';
    const transferUseBase64Encoding = true;
    const transferUse256BitesEncoding = true;
    /*END Transfered Keys - same as on client*/

    public function init()
    {
        $this->setGlobalKeys();
        parent::init();
    }

    public function setKeys($globalKeys = true){
        if($globalKeys === true) {
            $this->setGlobalKeys();
        }
        else{
            $this->setTransferKeys();
        }
    }

    public function encrypt($string, $globalKeys=true)
    {
        $this->setKeys($globalKeys);
        return parent::encrypt($string);
    }

    public function decrypt($string, $globalKeys=true)
    {
        $this->setKeys($globalKeys);
        return parent::decrypt($string);
    }

    public function setTransferKeys()
    {
        $this->setGlobalPassword(self::transferPassword);
        $this->setIv(self::transferIv);
        $this->setUse256BitesEncoding(self::transferUseBase64Encoding);
        $this->setUseBase64Encoding(self::transferUse256BitesEncoding);
    }

    public function setGlobalKeys(){
        $this->setGlobalPassword(self::password);
        $this->setIv(self::iv);
        $this->setUse256BitesEncoding(self::use256BitesEncoding);
        $this->setUseBase64Encoding(self::useBase64Encoding);
    }
}