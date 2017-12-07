<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 14.03.2016
 **** Time: 14:20
 */

namespace wbp\file\behaviors;

use wbp\file\models\File;
use wbp\images\models;
use wbp\images\ModuleTrait;
use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;

/**
 * Class FileBehave
 * @package wbp\file\behaviors
 */
class FileBehave extends Behavior
{

    use ModuleTrait;
    /**
     * @var bool
     */
    public $createAliasMethod = false;

    /**
     * @var ActiveRecord|null Model class, which will be used for storing image data in db, if not set default class(models/File) will be used
     */
    public $modelClass = null;

    /**
     * Clear all images cache (and resized copies)
     * @return bool
     */
    public function clearFilesCache()
    {
        $cachePath = $this->getModule()->getCachePath();
        $subdir = $this->getModule()->getModelSubDir($this->owner);

        $dirToRemove = $cachePath . '/' . $subdir;

        if (preg_match('/' . preg_quote($cachePath, '/') . '/', $dirToRemove)) {
            BaseFileHelper::removeDirectory($dirToRemove);
            //exec('rm -rf ' . $dirToRemove);
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param string $type
     * @return array|yii\db\ActiveRecord[]
     * @throws yii\base\Exception
     */
    public function getFiless($type='')
    {
        $finder = $this->getFilessFinder($type);

        $imageQuery = File::find()
            ->where($finder);

        $imageQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);

        $imageRecords = $imageQuery->all();
        if(!$imageRecords && Yii::$app->getModule('file')){
            return [$this->getModule()->getPlaceHolder()];
        }
        return $imageRecords;
    }


    /**
     * @param string $type
     * @return array|null|models\PlaceHolder|ActiveRecord
     * @throws yii\base\Exception
     */
    public function getFile($type='')
    {
        $finder = $this->getFilesFinder($type);
        $fileQuery = File::find()
            ->where($finder);
        $fileQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);

        $file = $fileQuery->one();

        return $file;
    }

    public function getImage(){
        if(!$this->file) return $this->owner->image;
        if(!$this->file->image->id) return $this->owner->image;

        return $this->file->image;
    }

    /**
     * @param string $type
     * @param bool $additionWhere
     * @return array
     */
    private function getFilesFinder($type='', $additionWhere = false)
    {
        if($type==''){
            $class=get_class($this->owner);
            $type=$class::$fileTypes[0];
        }

        $base = [
            'item_id' => $this->owner->id,
            'type' => $type,
            'parent' => null
        ];

        if ($additionWhere) {
            $base = \yii\helpers\BaseArrayHelper::merge($base, $additionWhere);
        }
        return $base;
    }

    
}


