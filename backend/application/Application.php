<?php
namespace backend\application;
use backend\models\Modules;
use Yii;

class Application extends \yii\web\Application{

    public function init(){
        parent::init();

        //HIDDEN "MUSTHAVE" MODULE
        $modules=[
            'moduleCreator' => [
                'class' => 'backend\modules\moduleCreator\Module'
            ],
            'icons' => [
                'class' => 'backend\modules\icons\Module'
            ]
        ];
        //END HIDDEN "MUSTHAVE" MODULE

        $modulesDB = Modules::find()->where(['status'=>1])->with('permissions')->all();
        foreach($modulesDB as $module){
            $modules[$module->name] = [
                'class' => $module->nameClass
            ];
        }

        Yii::configure($this,['modules'=>$modules]);
    }
}