<?php


/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $filePath
 * @property integer $itemId
 * @property integer $isMain
 * @property string $modelName
 * @property string $urlAlias
 */

namespace wbp\images\models;

use common\models\WbpActiveRecord;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use \wbp\images\ModuleTrait;



class Image extends WbpActiveRecord
{
    use ModuleTrait;

    const STATUS_ACTIVE=1;
    const STATUS_UNACTIVE=0;
    const DELETED=1;
    const NON_DELETED=0;

    const RESIZE_METHOD_CROP=1;
    const RESIZE_METHOD_RESIZE=2;
    const METHOD_THUMB=3;

    const COPY_SCENARIO='copy';


    private $helper = false;


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'added_date',
                'updatedAtAttribute' => 'updated_date',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'ext',
            'width',
            'height',
            'absoluteSourceUrl'
        ];
    }

    public function getChilds(){
        return $this->hasMany(Image::className(), ['parent' => 'id']);
    }

    public function getUrl($size = false, $method=3, $script=false){
//        $urlSize = ($size) ? '_'.$size : '';
        $path=$this->getPath($size, $method);
        if($script){
            $url = Url::toRoute([
                '/'.$this->getModule()->id.'/images/image-by-item',
                'item' => $this->id,
                'size' => $size,
                'method' => $method
            ]);
            exit;
            return $url;
        }else{
            $url='';
            if(isset(Yii::$app->params['siteUrl'])) $url=Yii::$app->params['siteUrl'];
            return $url.str_replace([$_SERVER['DOCUMENT_ROOT'],'\\'], ['','/'], $path);
        }

    }

    public function getImageName()
    {
        $name = explode('.', $this->name)[0];

        return $name;
    }

    public function getWidth($size = false, $method=1){
//        $urlSize = ($size) ? '_'.$size : '';
        if(!$size || $method==1) $width=$this->getSizes()['width'];
        else{

            $size = $this->getModule()->parseSize($size);
            if(!$size){
                throw new \Exception('Bad size..');
            }

            $sizes = $this->getSizes();

            $imageWidth = $sizes['width'];
            $imageHeight = $sizes['height'];
            $newSizes = [];
            if($imageWidth>$imageHeight){
                $width=$size['width'];
            }else{
                $k=$size['height']/$imageHeight;
                $width=$imageWidth*$k;
            }

        }


        return $width;
    }
    public function getAbsoluteUrl($size = false, $method=3){
//        $urlSize = ($size) ? '_'.$size : '';
        $this->getPath($size, $method);
        $url = Yii::$app->getUrlManager()->createAbsoluteUrl([
            '/'.$this->getModule()->id.'/images/image-by-item',
            'item' => $this->id,
            'size' => $size,
            'method' => $method
        ]);

        return $url;
    }

    public function getAbsoluteSourceUrl(){
        if($this->id)
            return 'http://'.$_SERVER['SERVER_NAME'].$this->url;
        else
            return '';
    }
//
    public function getPath($size = false,$method=3){
//        $urlSize = ($size) ? $size : false;
        $base = $this->getModule()->getCachePath();
        $sub = $this->getSubDur();

        $origin = $this->getPathToOrigin();

        if(!$size) return $origin;

        // create image sizes for crop function

        if(strpos($size,'x')!==false)
            list($width,$height)=explode('x',$size);
        else {
            $width=(int)$size;
            $height=0;
        }



        $className = \yii\helpers\StringHelper::basename(self::className());
        
        if($width && $height && $className!='PlaceHolder'){
            $imageSize=ImageSizes::find()->where([
                'type'=>$this->type,
                'aspect_ratio'=>sprintf("%01.5f",$width/$height)
            ])->one();

            if(!$imageSize){
                $imageSize=new ImageSizes();
                $imageSize->type=$this->type;
                $imageSize->aspect_ratio=sprintf("%01.5f",$width/$height);
                $imageSize->title=$width.'x'.$height;
                $imageSize->save();
            }

            if($method==self::METHOD_THUMB){
                $image=Image::find()->where([
                    'status'=>1,
                    'parent'=>$this->id,
                    'aspect_ratio'=>$imageSize->aspect_ratio
                ])->orderBy('id desc')->one();

                if($image) return $image->getPath($size);
            }
        }


        if($method==self::METHOD_THUMB) $method=1;

        $filePath = $base.DIRECTORY_SEPARATOR.$sub.DIRECTORY_SEPARATOR.$method.'_'.$size.'.'.$this->ext;
        if(!file_exists($filePath) && file_exists($origin)){
            $this->createVersion($origin, $size, $method);

            if(!file_exists($filePath)){
                throw new \Exception('Problem with image creating.');
            }
        }

        return $filePath;
    }

    public function getPathOnly($size = false, $method=3){
//        $urlSize = ($size) ? $size : false;
        $base = $this->getModule()->getCachePath();
        $sub = $this->getSubDur();

        $origin = $this->getPathToOrigin();

        if(!$size) return $origin;

        $filePath = $base.DIRECTORY_SEPARATOR.$sub.DIRECTORY_SEPARATOR.$method.'_'.$size.'.'.$this->ext;

        return $filePath;
    }
//
    public function getContent($size = false, $method=1){
        return file_get_contents($this->getPath($size, $method));
    }

    public function getContentOnly($size = false, $method=1){
        return file_get_contents($this->getPathOnly($size, $method));
    }
//
    public function getPathToOrigin(){

        $base = $this->getModule()->getStorePath();

        $filePath = $base.DIRECTORY_SEPARATOR.$this->id.'.'.$this->ext;

        return $filePath;
    }
//
//
    public function getSizes($force=false)
    {
        $sizes = false;
        if($this->getModule()->graphicsLibrary == 'Imagick'){
            $image = new \Imagick($this->getPathToOrigin());
            $sizes = $image->getImageGeometry();
        }else{
            if(!$this->width || !$this->height || $force){
                $image = new SimpleImage($this->getPathToOrigin());
                $sizes['width'] = $image->get_width();
                $sizes['height'] = $image->get_height();
                $this->width=$sizes['width'];
                $this->height=$sizes['height'];
                $this->aspect_ratio=sprintf("%01.5f",$this->width/$this->height);
                $this->save();
            }else{
                $sizes['width']=$this->width;
                $sizes['height']=$this->height;
            }

        }

        return $sizes;
    }
//
    public function getSizesWhen($sizeString){

        $size = $this->getModule()->parseSize($sizeString);
        if(!$size){
            throw new \Exception('Bad size..');
        }

        $sizes = $this->getSizes();

        $imageWidth = $sizes['width'];
        $imageHeight = $sizes['height'];
        $newSizes = [];
        if(!$size['width']){
            $newWidth = $imageWidth*($size['height']/$imageHeight);
            $newSizes['width'] = intval($newWidth);
            $newSizes['heigth'] = $size['height'];
        }elseif(!$size['height']){
            $newHeight = intval($imageHeight*($size['width']/$imageWidth));
            $newSizes['width'] = $size['width'];
            $newSizes['heigth'] = $newHeight;
        }

        return $newSizes;
    }
//
    public function createVersion($imagePath, $sizeString = false, $method=1)
    {
//        if(strlen($this->urlAlias)<1){
//            throw new \Exception('Image without urlAlias!');
//        }

        $cachePath = $this->getModule()->getCachePath();
        $subDirPath = $this->getSubDur();
        $fileExtension =  $this->ext;

        if($sizeString){
            $sizePart = $sizeString;
        }else{
            $sizePart = '';
        }

        $pathToSave = $cachePath.'/'.$subDirPath.'/'.$method.'_'.$sizePart.'.'.$fileExtension;

        BaseFileHelper::createDirectory(dirname($pathToSave), 0777, true);


        if($sizeString) {
            $size = $this->getModule()->parseSize($sizeString);
        }else{
            $size = false;
        }

            if($this->getModule()->graphicsLibrary == 'Imagick'){
                $image = new \Imagick($imagePath);
                $image->setImageCompressionQuality(100);

                if($size){
                    if($size['height'] && $size['width']){
                        $image->cropThumbnailImage($size['width'], $size['height']);
                    }elseif($size['height']){
                        $image->thumbnailImage(0, $size['height']);
                    }elseif($size['width']){
                        $image->thumbnailImage($size['width'], 0);
                    }else{
                        throw new \Exception('Something wrong with this->module->parseSize($sizeString)');
                    }
                }

                $image->writeImage($pathToSave);
            }else{

                $image = new SimpleImage($imagePath);

                if($size){
                    if($size['height'] && $size['width']){
                        if($method==self::RESIZE_METHOD_CROP){
                            $image->thumbnail($size['width'], $size['height']);
                        }elseif($method==self::RESIZE_METHOD_RESIZE){


                            $image->best_fit($size['width'], $size['height']);
                        }
                    }elseif($size['height']){
                        $image->fit_to_height($size['height']);
                    }elseif($size['width']){
                        $image->fit_to_width($size['width']);
                    }else{
                        throw new \Exception('Something wrong with this->module->parseSize($sizeString)');
                    }
                }

                //WaterMark
                if($this->getModule()->waterMark){

                    if(!file_exists(Yii::getAlias($this->getModule()->waterMark))){
                        throw new Exception('WaterMark not detected!');
                    }

                    $wmMaxWidth = intval($image->get_width()*0.4);
                    $wmMaxHeight = intval($image->get_height()*0.4);

                    $waterMarkPath = Yii::getAlias($this->getModule()->waterMark);

                    $waterMark = new SimpleImage($waterMarkPath);



                    if(
                        $waterMark->get_height() > $wmMaxHeight
                        or
                        $waterMark->get_width() > $wmMaxWidth
                    ){

                        $waterMarkPath = $this->getModule()->getCachePath().DIRECTORY_SEPARATOR.
                            pathinfo($this->getModule()->waterMark)['filename'].
                            $wmMaxWidth.'x'.$wmMaxHeight.'.'.
                            pathinfo($this->getModule()->waterMark)['extension'];

                        //throw new Exception($waterMarkPath);
                        if(!file_exists($waterMarkPath)){
                            $waterMark->fit_to_width($wmMaxWidth);
                            $waterMark->save($waterMarkPath, 100);
                            if(!file_exists($waterMarkPath)){
                                throw new Exception('Cant save watermark to '.$waterMarkPath.'!!!');
                            }
                        }

                    }

                    $image->overlay($waterMarkPath, 'bottom right', .5, -10, -10);

                }

                $image->save($pathToSave, 100);
            }

        return $image;

    }
//
//
//    public function setMain($isMain = true){
//        if($isMain){
//            $this->isMain = 1;
//        }else{
//            $this->isMain = 0;
//        }
//
//    }
//
    protected function getSubDur(){
//        return $this->type. '/' . $this->id;
        return $this->id;
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'ext'], 'required'],
            [['item_id', 'status', 'deleted'], 'integer'],
//            [['filePath', 'urlAlias'], 'string', 'max' => 400],
//            [['modelName'], 'string', 'max' => 150]

//            [['filePath', 'itemId', 'modelName', 'urlAlias'], 'required'],
//            [['itemId', 'isMain'], 'integer'],
//            [['filePath', 'urlAlias'], 'string', 'max' => 400],
            [[
                'item_id',
                'type',
                'status',
                'deleted',
                'unique_id',
                'name',
                'ext',
                'width',
                'height',
                'added_date',
                'updated_date',
                'sort',
                'aspect_ratio',
                'parent',
            ], 'safe', 'on' => [self::COPY_SCENARIO]]

        ];
    }

    public function beforeDelete()
    {
        $childs=$this->childs;
        foreach ($childs as $image) $image->delete();

        if(file_exists($this->getPathToOrigin())) unlink($this->getPathToOrigin());

        return parent::beforeDelete();
    }

    public function createThumb(){
        $this->getSizes();

        $newImage=new Image();
        $newImage->scenario=self::COPY_SCENARIO;
        $newImage->load($this->getAttributes(),'');
        $newImage->parent=$this->id;
        $newImage->ext='png';
        $newImage->save();
        if(file_exists($newImage->getPathToOrigin())) unlink($newImage->getPathToOrigin());
        copy($this->getPathToOrigin(), $newImage->getPathToOrigin());
        return $newImage;
    }

    public function rotate($angle, $pathToSave=''){

        if(!$pathToSave) $pathToSave=$this->getPathToOrigin();

        if($this->getModule()->graphicsLibrary == 'Imagick'){
            // TODO: make this for imagick
        }else{
            $image = new SimpleImage($this->getPathToOrigin());

            $image->rotate($angle,[255,255,255,0]);

            $image->save($pathToSave, 100, 'png');
            $this->getSizes(true);
        }
    }

    public function flip($direction, $pathToSave=''){

        if(!$pathToSave) $pathToSave=$this->getPathToOrigin();

        if($this->getModule()->graphicsLibrary == 'Imagick'){
            // TODO: make this for imagick
        }else{
            $image = new SimpleImage($this->getPathToOrigin());

            $image->flip($direction);

            $image->save($pathToSave, 100, 'png');
        }
    }

    public function crop($x, $y, $width, $height, $pathToSave=''){

        if(!$pathToSave) $pathToSave=$this->getPathToOrigin();

        if($this->getModule()->graphicsLibrary == 'Imagick'){
            // TODO: make this for imagick
        }else{
            $image = new SimpleImage($this->getPathToOrigin());

            $image->crop($x, $y, $width + $x, $height + $y);

            $image->save($pathToSave, 100, 'png');
            $this->getSizes(true);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Image Type',
            'item_id' => 'Item ID',
            'ext' => 'Image Extentions',
            'status' => 'Image Status',
            'deleted' => 'Deleted Flag',
        ];
    }
}
