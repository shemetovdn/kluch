<?php
namespace backend\modules\agents;

class Module extends \yii\base\Module
{
    public $controllerNamespace;

    public $text = [
        'add_item' => 'Создать Агента',
        'module_name' => 'Агенты',
        'edit_item' => 'Редактирование Агента',
        'remove_item' => 'Удалить',
        'remove_confirmation' => 'Уверенны что хотите удвлить?',
        'module_manage' => 'Управление Агентами',
        'total_items' => 'Всего Агентов',
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
