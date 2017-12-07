<?php
/**
 * Created by PhpStorm.
 * User: costa
 * Date: 25.06.14
 * Time: 15:35
 */

namespace wbp\file\controllers;

use wbp\file\ModuleTrait;
use yii\web\Controller;

class GetController extends Controller
{
    use ModuleTrait;
    public function actionIndex()
    {
        echo "Hello, man. It's ok, dont worry.";
    }

    /**
     *
     * All we need is love. No.
     * We need item (by id or another property) and alias (or images number)
     * @param $item
     * @param $size
     *
     */
    public function actionFileByItem($item='')
    {

        $file= $this->getModule()->getFile($item);


        if($file){
//            header('Content-Type: image/jpg');
            echo $file->getContent();
//            echo $image->getContent($size);
        }else{
            throw new \yii\web\HttpException(404, 'There is no file');
        }

    }
}