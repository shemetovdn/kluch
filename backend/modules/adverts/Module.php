<?php

namespace backend\modules\adverts;

class Module extends \yii\base\Module
{
    public $controllerNamespace;

    public $text = [
        'add_item' => 'Добавить объявление',
        'module_name' => 'Объявления',
        'edit_item' => 'Править объявление',
        'remove_item' => 'Удалить',
        'remove_confirmation' => 'Are you sure want to delete this item?',
        'module_manage' => 'Управление Объявлениями',
        'total_items' => 'Всего Объявлений',
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
