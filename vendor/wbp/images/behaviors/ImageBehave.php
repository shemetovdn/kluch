<?php
/**
 * Created by PhpStorm.
 * User: kostanevazno
 * Date: 22.06.14
 * Time: 16:58
 */

namespace wbp\images\behaviors;


use wbp\images\models\Image;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use wbp\images\models;
use yii\helpers\BaseFileHelper;
use \wbp\images\ModuleTrait;


class ImageBehave extends Behavior
{

    use ModuleTrait;
    public $createAliasMethod = false;

    /**
     * @var ActiveRecord|null Model class, which will be used for storing image data in db, if not set default class(models/Image) will be used
     */
    public $modelClass = null;

    /**
     * Clear all images cache (and resized copies)
     * @return bool
     */
    public function clearImagesCache()
    {
        $cachePath = $this->getModule()->getCachePath();
        $subdir = $this->getModule()->getModelSubDir($this->owner);

        $dirToRemove = $cachePath . '/' . $subdir;

        if (preg_match('/' . preg_quote($cachePath, '/') . '/', $dirToRemove)) {
            BaseFileHelper::removeDirectory($dirToRemove);
            return true;
        } else {
            return false;
        }
    }


    /**
     * Returns model images
     * First image alwats must be main image
     * @return array|yii\db\ActiveRecord[]
     */
    public function getImages($type = '', $placeholder = true)
    {
        $finder = $this->getImagesFinder($type);

        $imageQuery = Image::find()
            ->where($finder);

        $imageQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);

        $imageRecords = $imageQuery->all();
        if (!$imageRecords && Yii::$app->getModule('im') && $placeholder) {
            return [$this->getModule()->getPlaceHolder()];
        }
        return $imageRecords;
    }


    /**
     * returns main model image
     * @return array|null|ActiveRecord
     */
    public function getImage($type = '')
    {
        $finder = $this->getImagesFinder($type);
        $imageQuery = Image::find()
            ->where($finder);
        $imageQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
        $img = $imageQuery->one();
        if (!$img && Yii::$app->getModule('im')) {
            return $this->getModule()->getPlaceHolder();
        }
        return $img;
    }

    private function getImagesFinder($type = '', $additionWhere = false)
    {
        if ($type == '') {
            $class = get_class($this->owner);
            $type = $class::$imageTypes[0];
        }

        $base = [
            'item_id' => $this->owner->id,
            'type' => $type
        ];

        if ($additionWhere) {
            $base = \yii\helpers\BaseArrayHelper::merge($base, $additionWhere);
        }
        return $base;
    }
}


