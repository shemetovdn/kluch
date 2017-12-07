<?php
/**
 * Created by PhpStorm.
 * User: costa
 * Date: 25.06.14
 * Time: 15:35
 */

namespace wbp\images\controllers;

use demi\cropper\Cropper;
use wbp\images\models\ImageSizes;
use yii\web\Controller;
use yii;
use wbp\images\models\Image;
use \wbp\images\ModuleTrait;

class CropController extends Controller
{
    public function checkAccess($id,$type,$itemId){
        $cropAccess=Yii::$app->session->get('cropAccess');
        if(!$cropAccess) $cropAccess=[];

        foreach ($cropAccess as $unit){
            if($unit['type']==$type && $unit['itemId']==$itemId && $unit['size']==$id) return true;
        }

        return false;
    }

    public function actionSize($id,$type){

        $itemId=Yii::$app->request->get('itemId',0);
        $imageId=Yii::$app->request->get('imageId',0);
        $cropped='';
        $size=ImageSizes::find()->where([
            'id'=>$id,
            'status'=>1,
        ])->one();

        if(!$this->checkAccess($id,$type,$itemId) || !$size) throw new yii\web\NotFoundHttpException('Page not found.');


        if($imageId){
            $image=Image::find()->where([
                'id'=>$imageId,
                'type'=>$type,
                'parent'=>null
            ])->orderBy('id desc')->one();
            $itemId=$image->item_id;
        }else{
            $image=Image::find()->where([
                'item_id'=>$itemId,
                'type'=>$type,
                'parent'=>null
            ])->orderBy('id desc')->one();
        }

        if($image){
            $cropped=Image::find()->where([
                'item_id'=>$itemId,
                'type'=>$type,
                'parent'=>$image->id,
                'aspect_ratio'=>$size->aspect_ratio
            ])->orderBy('id desc')->one();
        }

        $croper_widget_id=Yii::$app->request->get('widget_id');


        if($cropped){
            $data=\yii\helpers\Json::decode($cropped->crop_data);
            foreach ($data as $name=>$value) $data[$name]=1*$value;
        }else{
            $data=[];
        }

        $result=$this->renderAjax('size',['image'=>$image,'size'=>$size,'data'=>$data,'itemId'=>$itemId,'imageId'=>$imageId,'type'=>$type,'croper_widget_id'=>$croper_widget_id]);
        return yii\helpers\Json::encode($result);

    }

    public function actionCropImage(){
        $itemId=Yii::$app->request->post('itemId');
        $imageId=Yii::$app->request->post('imageId');
        $type=Yii::$app->request->post('type');
        $id=Yii::$app->request->post('id');

        $size=ImageSizes::find()->where([
            'id'=>$id,
            'status'=>1,
        ])->one();

        if(!$this->checkAccess($id,$type,$itemId) || !$size) throw new yii\web\NotFoundHttpException('Page not found.');

        if($imageId){
            $image=Image::find()->where([
                'id'=>$imageId,
                'type'=>$type,
                'parent'=>null
            ])->orderBy('id desc')->one();
            $itemId=$image->item_id;
        }else {
            $image = Image::find()->where([
                'item_id' => $itemId,
                'type' => $type,
                'parent' => null
            ])->orderBy('id desc')->one();
        }

        $cropped=Image::find()->where([
            'item_id'=>$itemId,
            'type'=>$type,
            'parent'=>$image->id,
            'aspect_ratio'=>$size->aspect_ratio
        ])->all();

        foreach ($cropped as $thumb) $thumb->delete();

        $image=$image->createThumb();

        $rotate=Yii::$app->request->post('rotate');
        $scaleX=Yii::$app->request->post('scaleX');
        $scaleY=Yii::$app->request->post('scaleY');

        $x=Yii::$app->request->post('x');
        $y=Yii::$app->request->post('y');
        $width=Yii::$app->request->post('width');
        $height=Yii::$app->request->post('height');

        if($scaleX<0) $image->flip('x');
        if($scaleY<0) $image->flip('y');
        if($rotate) $image->rotate($rotate);

        $image->crop($x, $y, $width, $height);

        $image->crop_data=yii\helpers\Json::encode([
            'x'=>$x,
            'y'=>$y,
            'width'=>$width,
            'height'=>$height,
            'scaleX'=>$scaleX,
            'scaleY'=>$scaleY,
            'rotate'=>$rotate
        ]);
        $image->aspect_ratio=$size->aspect_ratio;

        $image->save();

    }

    public function actionRemoveImage(){
        $itemId=Yii::$app->request->post('itemId');
        $type=Yii::$app->request->post('type');
        $id=Yii::$app->request->post('id');

        $size=ImageSizes::find()->where([
            'id'=>$id,
            'status'=>1,
        ])->one();

        if(!$this->checkAccess($id,$type,$itemId) || !$size) throw new yii\web\NotFoundHttpException('Page not found.');


        $images=Image::find()->where([
            'item_id'=>$itemId,
            'type'=>$type,
            'parent'=>null,
            'size_id'=>null
        ])->orderBy('id desc');

        if(!$images->count()){
            $images=Image::find()->where([
                'item_id'=>$itemId,
                'type'=>$type,
                'parent'=>null,
                'size_id'=>$size->id
            ])->orderBy('id desc');
        }

        foreach ($images->all() as $image) $image->delete();

    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [

            'uploadImage' => [
                'class' => \wbp\uploadifive\UploadAction::className(),
                'uploadBasePath' => '@serverDocumentRoot/images/tmp', //file system path
//                'uploadBaseUrl' => \common\helpers\Url::getWebUrlFrontend('upload'), //web path
                'csrf' => false,
                'format' => '{yyyy}-{mm}-{dd}-{time}-{rand:6}', //save format
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 10 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function ($actionObject) {
                },
                'afterValidate' => function ($actionObject) {
                },
                'beforeSave' => function ($actionObject) {
                },
                'afterSave' => function ($filename, $fullFilename, $actionObject) {

                    $itemId=Yii::$app->request->post('item_id');
                    $type=Yii::$app->request->post('type');
                    $id=Yii::$app->request->post('id');

                    $size=ImageSizes::find()->where([
                        'id'=>$id,
                        'status'=>1,
                    ])->one();

                    if(!$this->checkAccess($id,$type,$itemId) || !$size) throw new yii\web\NotFoundHttpException('Page not found.');

                    //$filename; // image/yyyymmddtimerand.jpg
                    //$fullFilename; // /var/www/htdocs/image/yyyymmddtimerand.jpg
                    //$actionObject; // \wbp\uploadifive\UploadAction instance

                    $dir = Yii::getAlias(Yii::$app->getModule('im')->imagesStorePath);


//                    $itemId=Yii::$app->getRequest()->post('item_id');
//                    $type = Yii::$app->getRequest()->post('type');
                    $unique_id = Yii::$app->getRequest()->post('uniqueId');
                    $ext = pathinfo($fullFilename, PATHINFO_EXTENSION);


                    $image = new Image();
                    $image->type = $type;
                    $image->item_id = $itemId;
                    $image->unique_id = $unique_id;
                    $image->ext = $ext;
                    $image->status = Image::STATUS_ACTIVE;
                    $image->deleted = Image::NON_DELETED;
                    $image->name = $actionObject->getUpladedFileName();
                    file_put_contents(Yii::getAlias('@serverDocumentRoot/images/') . '/1', $dir . '/' . $image->id . '.' . $image->ext);

                    $image->save();

                    rename($fullFilename, $dir . '/' . $image->id . '.' . $image->ext);

                },
            ],

        ];
    }


}