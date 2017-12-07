<?php

namespace backend\modules\objectTypes;

class Module extends \yii\base\Module
{
    public $controllerNamespace;

    public $text = [
        'add_item' => 'Добавить тип Объекта',
        'module_name' => 'Типы Объектов',
        'edit_item' => 'Править тип Объекта',
        'remove_item' => 'Удалить',
        'remove_confirmation' => 'Хотите удалить?',
        'module_manage' => 'Управление типами объектов',
        'total_items' => 'Всего типов объектов',
    ];

    public $actions;

    public static $module_actions = [
        'enable_add' => true,
        'enable_edit' => true,
        'enable_delete' => true,
        'enable_view' => true,
    ];

    public function init()
    {
        $this->actions=self::$module_actions;
        $tmp = explode(DIRECTORY_SEPARATOR, __DIR__);
        $tmp = $tmp[count($tmp) - 1];
        $this->controllerNamespace = 'backend\modules\\' . $tmp . '\controllers';

        parent::init();
    }
}
