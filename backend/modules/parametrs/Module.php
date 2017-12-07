<?php
namespace backend\modules\parametrs;

class Module extends \yii\base\Module
{
    public $controllerNamespace;

    public $text = [
        'add_item' => 'Добавить Параметр',
        'module_name' => 'Параметры',
        'edit_item' => 'Изменить Параметр',
        'remove_item' => 'Remove',
        'remove_confirmation' => 'Вы уверены что хотите удалить параметр',
        'module_manage' => 'Управление Параметрами',
        'total_items' => 'Всего Параметров',
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
