<?php

namespace wbp\file;


use yii;

class Module extends \yii\base\Module
{
    public $fileStorePath = '@app/web/store';

    public $controllerNamespace = 'wbp\file\controllers';

    public function getStorePath()
    {
        return Yii::getAlias($this->fileStorePath);
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


    public function getFile($item)
    {
        $itemId = (int)$item;
        $file = File::find()
            ->where(['id' => $itemId])
            ->one();

        if(!$file){
            return false;
        }

        return $file;
    }

    public function init()
    {
        parent::init();
        if (!$this->fileStorePath
            or
            $this->fileStorePath == '@app'
        )
            throw new \Exception('Setup filesStorePath and filesCachePath images module properties!!!');
        // custom initialization code goes here
    }

}
