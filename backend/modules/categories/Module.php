<?php

namespace backend\modules\categories;

class Module extends \yii\base\Module
{
    public $controllerNamespace;

    public $text = [
        'add_item' => 'Add Categories',
        'module_name' => 'Categories',
        'edit_item' => 'Edit Category',
        'remove_item' => 'Remove',
        'remove_confirmation' => 'Are you sure want to delete this item?',
        'module_manage' => 'Manage Categories',
        'total_items' => 'Total Categories',
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
