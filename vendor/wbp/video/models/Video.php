<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 14.03.2016
 **** Time: 14:38
 */

namespace wbp\video\models;

use wbp\video\ModuleTrait;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;


class Video extends \yii\db\ActiveRecord
{
    use ModuleTrait;

    const STATUS_ACTIVE = 1;
    const STATUS_Inactive = 0;
    const DELETED = 1;
    const NON_DELETED = 0;

    const RESIZE_METHOD_CROP = 1;
    const RESIZE_METHOD_RESIZE = 2;


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
            'absoluteSourceUrl'
        ];
    }

    public function getUrl($size = false, $method = 1, $script = false)
    {
//        $urlSize = ($size) ? '_'.$size : '';
        $path = $this->getPath($size, $method);

        if ($script) {
            $url = Url::toRoute([
                '/' . $this->getModule()->id . '/images/image-by-item',
                'item' => $this->id,
                'size' => $size,
                'method' => $method
            ]);
            return $url;
        } else {
            return str_replace([$_SERVER['DOCUMENT_ROOT'], '\\'], ['', '/'], $path);
        }
    }

    public function getWidth($size = false, $method = 1)
    {
//        $urlSize = ($size) ? '_'.$size : '';
        if (!$size || $method == 1) $width = $this->getSizes()['width'];
        else {

            $size = $this->getModule()->parseSize($size);
            if (!$size) {
                throw new \Exception('Bad size..');
            }

            $sizes = $this->getSizes();

            $imageWidth = $sizes['width'];
            $imageHeight = $sizes['height'];
            $newSizes = [];
            if ($imageWidth > $imageHeight) {
                $width = $size['width'];
            } else {
                $k = $size['height'] / $imageHeight;
                $width = $imageWidth * $k;
            }

        }


        return $width;
    }

    public function getAbsoluteUrl($size = false, $method = 1)
    {
//        $urlSize = ($size) ? '_'.$size : '';
        $this->getPath($size, $method);
        $url = Yii::$app->getUrlManager()->createAbsoluteUrl([
            '/' . $this->getModule()->id . '/images/image-by-item',
            'item' => $this->id,
            'size' => $size,
            'method' => $method
        ]);

        return $url;
    }

    public function getAbsoluteSourceUrl()
    {
        if ($this->id)
            return 'http://' . $_SERVER['SERVER_NAME'] . $this->url;
        else
            return '';
    }

//
    public function getPath($size = false, $method = 1)
    {
//        $urlSize = ($size) ? $size : false;
        $base = $this->getModule()->getCachePath();
        $sub = $this->getSubDur();

        $origin = $this->getPathToOrigin();

        if (!$size) return $origin;

        $filePath = $base . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR . $method . '_' . $size . '.' . $this->ext;
        if (!file_exists($filePath) && file_exists($origin)) {
            $this->createVersion($origin, $size, $method);

            if (!file_exists($filePath)) {
                throw new \Exception('Problem with image creating.');
            }
        }

        return $filePath;
    }

    public function getPathOnly($size = false, $method = 1)
    {
//        $urlSize = ($size) ? $size : false;
        $base = $this->getModule()->getCachePath();
        $sub = $this->getSubDur();

        $origin = $this->getPathToOrigin();

        if (!$size) return $origin;

        $filePath = $base . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR . $method . '_' . $size . '.' . $this->ext;

        return $filePath;
    }

//
    public function getContent($size = false, $method = 1)
    {
        return file_get_contents($this->getPath($size, $method));
    }

    public function getContentOnly($size = false, $method = 1)
    {
        return file_get_contents($this->getPathOnly($size, $method));
    }

//
    public function getPathToOrigin()
    {

        $base = $this->getModule()->getStorePath();

        $filePath = $base . DIRECTORY_SEPARATOR . $this->id . '.' . $this->ext;

        return $filePath;
    }
//
//
    public function getSizes()
    {
        $sizes = false;
        if ($this->getModule()->graphicsLibrary == 'Imagick') {
            $image = new \Imagick($this->getPathToOrigin());
            $sizes = $image->getImageGeometry();
        } else {
            if (!$this->width || !$this->height) {
                $image = new SimpleImage($this->getPathToOrigin());
                $sizes['width'] = $image->get_width();
                $sizes['height'] = $image->get_height();
                $this->width = $sizes['width'];
                $this->height = $sizes['height'];
                $this->save();
            } else {
                $sizes['width'] = $this->width;
                $sizes['height'] = $this->height;
            }

        }

        return $sizes;
    }

//
    public function getSizesWhen($sizeString)
    {

        $size = $this->getModule()->parseSize($sizeString);
        if (!$size) {
            throw new \Exception('Bad size..');
        }

        $sizes = $this->getSizes();

        $imageWidth = $sizes['width'];
        $imageHeight = $sizes['height'];
        $newSizes = [];
        if (!$size['width']) {
            $newWidth = $imageWidth * ($size['height'] / $imageHeight);
            $newSizes['width'] = intval($newWidth);
            $newSizes['heigth'] = $size['height'];
        } elseif (!$size['height']) {
            $newHeight = intval($imageHeight * ($size['width'] / $imageWidth));
            $newSizes['width'] = $size['width'];
            $newSizes['heigth'] = $newHeight;
        }

        return $newSizes;
    }

//
    public function createVersion($imagePath, $sizeString = false, $method = 1)
    {

        $cachePath = $this->getModule()->getCachePath();
        $subDirPath = $this->getSubDur();
        $fileExtension = $this->ext;

        if ($sizeString) {
            $sizePart = $sizeString;
        } else {
            $sizePart = '';
        }

        $pathToSave = $cachePath . '/' . $subDirPath . '/' . $method . '_' . $sizePart . '.' . $fileExtension;

        BaseFileHelper::createDirectory(dirname($pathToSave), 0777, true);


        if ($sizeString) {
            $size = $this->getModule()->parseSize($sizeString);
        } else {
            $size = false;
        }

        if ($this->getModule()->graphicsLibrary == 'Imagick') {
            $image = new \Imagick($imagePath);
            $image->setImageCompressionQuality(100);

            if ($size) {
                if ($size['height'] && $size['width']) {
                    $image->cropThumbnailImage($size['width'], $size['height']);
                } elseif ($size['height']) {
                    $image->thumbnailImage(0, $size['height']);
                } elseif ($size['width']) {
                    $image->thumbnailImage($size['width'], 0);
                } else {
                    throw new \Exception('Something wrong with this->module->parseSize($sizeString)');
                }
            }

            $image->writeImage($pathToSave);
        } else {

            $image = new SimpleImage($imagePath);

            if ($size) {
                if ($size['height'] && $size['width']) {
                    if ($method == self::RESIZE_METHOD_CROP) {
                        $image->thumbnail($size['width'], $size['height']);
                    } elseif ($method == self::RESIZE_METHOD_RESIZE) {


                        $image->best_fit($size['width'], $size['height']);
                    }
                } elseif ($size['height']) {
                    $image->fit_to_height($size['height']);
                } elseif ($size['width']) {
                    $image->fit_to_width($size['width']);
                } else {
                    throw new \Exception('Something wrong with this->module->parseSize($sizeString)');
                }
            }

            //WaterMark
            if ($this->getModule()->waterMark) {

                if (!file_exists(Yii::getAlias($this->getModule()->waterMark))) {
                    throw new Exception('WaterMark not detected!');
                }

                $wmMaxWidth = intval($image->get_width() * 0.4);
                $wmMaxHeight = intval($image->get_height() * 0.4);

                $waterMarkPath = Yii::getAlias($this->getModule()->waterMark);

                $waterMark = new SimpleImage($waterMarkPath);


                if (
                    $waterMark->get_height() > $wmMaxHeight
                    or
                    $waterMark->get_width() > $wmMaxWidth
                ) {

                    $waterMarkPath = $this->getModule()->getCachePath() . DIRECTORY_SEPARATOR .
                        pathinfo($this->getModule()->waterMark)['filename'] .
                        $wmMaxWidth . 'x' . $wmMaxHeight . '.' .
                        pathinfo($this->getModule()->waterMark)['extension'];

                    //throw new Exception($waterMarkPath);
                    if (!file_exists($waterMarkPath)) {
                        $waterMark->fit_to_width($wmMaxWidth);
                        $waterMark->save($waterMarkPath, 100);
                        if (!file_exists($waterMarkPath)) {
                            throw new Exception('Cant save watermark to ' . $waterMarkPath . '!!!');
                        }
                    }

                }

                $image->overlay($waterMarkPath, 'bottom right', .5, -10, -10);

            }

            $image->save($pathToSave, 100);
        }

        return $image;

    }

    protected function getSubDur()
    {
        return $this->id;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'ext'], 'required'],
            [['item_id', 'status', 'deleted'], 'integer'],
        ];
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
