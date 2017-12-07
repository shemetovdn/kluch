<?php

namespace wbp\video;


use yii;

class Module extends \yii\base\Module
{
    public $videoStorePath = '@app/web/store';

    public $controllerNamespace = 'wbp\video\controllers';

    public function getStorePath()
    {
        return Yii::getAlias($this->videoStorePath);
    }

    public function getModelSubDir($model)
    {
        $modelName = $this->getShortClass($model);
        $modelDir = $modelName . 's/' . $modelName . $model->id;

        return $modelDir;
    }

    public function getShortClass($obj)
    {
        $className = get_class($obj);

        if (preg_match('@\\\\([\w]+)$@', $className, $matches)) {
            $className = $matches[1];
        }

        return $className;
    }


    public function getVideo($item)
    {
        $itemId = (int)$item;
        $video = Video::find()
            ->where(['id' => $itemId])
            ->one();

        if(!$video){
            return false;
        }

        return $video;
    }

    public function init()
    {
        parent::init();
        if (!$this->videoStorePath
            or
            $this->videoStorePath == '@app'
        )
            throw new \Exception('Setup imagesStorePath and imagesCachePath images module properties!!!');
        // custom initialization code goes here
    }

}
