<?php

namespace backend\modules\moduleCreator\models;

use backend\models\BaseFormModel;

class ModulesForm extends BaseFormModel{
    public $modelName='backend\models\Modules';

    public $id,
        $title,
        $status,$class_name,$name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','status','class_name','name'],'safe','on'=>['edit','add']],
            [['title','class_name','name'],'required'],
            ['name','unique','filter'=>['<>','id',$this->id],'targetClass' => 'backend\models\Modules', 'message' => 'This name has already been taken.','on'=>['edit','add']],
            ['class_name','unique','filter'=>['<>','id',$this->id],'targetClass' => 'backend\models\Modules', 'message' => 'This Class Name has already been used in other place.','on'=>['edit','add']]
        ];
    }


}