<?php
/**
 * Created by PhpStorm.
 * User: costa
 * Date: 25.06.14
 * Time: 15:35
 */

namespace wbp\images\controllers;

use yii\web\Controller;
use yii;
use wbp\images\models\Image;
use \wbp\images\ModuleTrait;

class ImagesController extends Controller
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
    public function actionImageByItem($item='',$size='', $method=1)
    {
//        echo $item; exit();
//        $dotParts = explode('.', $dirtyAlias);
//        if(!isset($dotParts[1])){
//            throw new \yii\web\HttpException(404, 'Image must have extension');
//        }
//        $dirtyAlias = $dotParts[0];

        $size = isset($size) ? $size : false;
        $image = $this->getModule()->getImage($item, $size);

//        if($image->getExtension() != $dotParts[1]){
//            throw new \yii\web\HttpException(404, 'Image not found (extenstion)');
//        }

        if($image){
            header('Content-Type: image/jpg');
            echo $image->getContent($size, $method);
//            echo $image->getContent($size);
        }else{
            throw new \yii\web\HttpException(404, 'There is no images');
        }

    }
}