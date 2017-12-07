<?php

namespace wbp\video;

use common\models\WbpActiveRecord;

/**
 * Class Video
 * @package wbp\video
 */
class Video extends WbpActiveRecord{

    use ModuleTrait;

    const DELETED=1;
    const NON_DELETED=0;

    public static $imageTypes=["ConvertedVideoThumb_AASSDDEEWWQQ"];


    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%video_files}}';
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getPathToOrigin(){

        $base = $this->getModule()->getStorePath();

        $filePath = $base.DIRECTORY_SEPARATOR.$this->id.'.'.$this->ext;

        return $filePath;
    }

    /**
     * @return string
     */
    public function getContent(){
        return file_get_contents($this->getPath());
    }

    /**
     * @return mixed
     */
    protected function getSubDir(){
        return $this->id;
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        unlink($this->getPathToOrigin());

        return parent::beforeDelete();
    }

    /**
     * @param string $type
     * @return bool|mixed
     */
    public function getUrl($type=''){

        $converted = $this->getConvertedVideo()->all();
//        var_dump($this->id);
//        var_dump($converted);
        if($converted){
            foreach($converted as $video){
                if($video->ext==$type) return $video->getOriginUrl();
            }
        }
        if($type==$this->ext)
            return $this->getOriginUrl();
        else
            return false;
    }

    /**
     * @return mixed
     */
    public function getOriginUrl(){
        $path=$this->getPathToOrigin();
        return str_replace([$_SERVER['DOCUMENT_ROOT'],'\\'], ['','/'], $path);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvertedVideo(){
        return $this->hasMany(Video::className(), ['parent'=>'id']);
    }

    /**
     * @return string
     */
    public function getPath(){
        $origin = $this->getPathToOrigin();

        return $origin;
    }

}