<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 14.03.2016
 **** Time: 14:20
 */

namespace wbp\video\behaviors;

use common\models\Config;
use wbp\images\models;
use wbp\images\ModuleTrait;
use wbp\video\Video;
use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;

/**
 * Class VideoBehave
 * @package wbp\video\behaviors
 */
class VideoBehave extends Behavior
{

    use ModuleTrait;
    /**
     * @var bool
     */
    public $createAliasMethod = false;

    /**
     * @var ActiveRecord|null Model class, which will be used for storing image data in db, if not set default class(models/Video) will be used
     */
    public $modelClass = null;

    /**
     * Clear all images cache (and resized copies)
     * @return bool
     */
    public function clearVideosCache()
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
    public function getVideos($type='')
    {
        $finder = $this->getVideosFinder($type);

        $imageQuery = Video::find()
            ->where($finder);

        $imageQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);

        $imageRecords = $imageQuery->all();
        if(!$imageRecords && Yii::$app->getModule('video')){
            return [$this->getModule()->getPlaceHolder()];
        }
        return $imageRecords;
    }


    /**
     * @param string $type
     * @return array|null|models\PlaceHolder|ActiveRecord
     * @throws yii\base\Exception
     */
    public function getVideo($type='')
    {
        $finder = $this->getVideosFinder($type);
        $videoQuery = Video::find()
            ->where($finder);
        $videoQuery->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);

        $video = $videoQuery->one();

        return $video;
    }

    public function getImage(){
        if(!$this->video) return $this->owner->image;
        if(!$this->video->image->id) return $this->owner->image;

        return $this->video->image;
    }

    /**
     * @param string $type
     * @param bool $additionWhere
     * @return array
     */
    private function getVideosFinder($type='', $additionWhere = false)
    {
        if($type==''){
            $class=get_class($this->owner);
            $type=$class::$videoTypes[0];
        }

        $base = [
            'item_id' => $this->owner->id,
            'type' => $type,
            //'parent' => null
        ];

        if ($additionWhere) {
            $base = \yii\helpers\BaseArrayHelper::merge($base, $additionWhere);
        }
        return $base;
    }

    public function getVideoInPlayer($width = '', $height = 480, $image='', $jsOptions=[])
    {
        if(!$image) $image=$this->image;
        if(!$this->video) return yii\bootstrap\Html::img($image->getUrl());

        if(!$width) $width='100%';

        $out = \yii\jwplayer\JWPlayer::widget([
            'id'=>'JW_Player_'.$this->owner->video->id,
            'key' => Config::getParameter('jwplayer_key'),
            'clientOptions' => yii\helpers\ArrayHelper::merge(
                [
                    'width' => $width,
                    'height' => $height,
                    'playlist' => [
                        'sources' => [
                            ['file'  => $this->video->getUrl('mp4')],
                            ['file'  => $this->video->getUrl('webm')],
                            ['file'  => $this->video->getUrl('ogv')],
                            ['file'  => $this->video->getUrl('flv')]
                        ],
                        'image' => $image->getUrl(),
                    ],
                    'primary' => 'html5',
                    'skin' => 'six',
                ],
                $jsOptions
            )
        ]);
        return $out;
    }


}


