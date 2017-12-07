<?php
namespace backend\models;

use backend\modules\stores\models\Stores;
use common\models\WbpActiveRecord;
use Yii;

class Menu extends WbpActiveRecord{
    public static function tableName(){
        return '{{%menu}}';
    }

    public function getModule(){
        return $this->hasOne(Modules::className(), ['id' => 'module_id']);
    }

    public function getChilds(){
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    public function getAction(){
        return $this->action ? $this->action : 'index';
    }



    public static function getMenuItems(){
        $menuItems=self::find()->where(['status'=>1, 'parent'=>0])->orderBy(['sort' => SORT_DESC])->all();
        $result = [];
        foreach($menuItems as $k=>$item){
            if(Yii::$app->user->id && !Yii::$app->user->identity->checkPermission($item->module->name, 'index')) continue;
            if($item->module->status==0) continue;
            $result[$k] = $item->menuItem;
        }
        return $result;
    }

    public static function getMenuItemsByStore()
    {
        $return = [];
        /** ���������� ������ ������������ �������� � ������ ���� */
        $items = self::getMenuItems();
        $itemsStore = Stores::findOne(['id' => Yii::$app->currentStore->storeId]);
        if($itemsStore){
            $modulesId = $itemsStore->getIdModules();
            foreach ($items as $v) {
                if(!in_array($v['module_id'], $modulesId)) {
                    continue;
                }else{
                    $return[] = $v;
                }
            }
        }
        return $return;
    }


    public function getMenuItem(){
        $result = [];
        $result['id'] = $this->id;
        $result['module_id'] = $this->module_id;
        $result['label'] = $this->title;

        $result['controller'] = !$this->controller ? 'default' : $this->controller;

        $result['url'] = ['/'.$this->module->name.'/'.$result['controller'].'/'.$this->action];
        $result['class'] = $this->icon_class;
        if($this->getChilds()->count()){
            $result['options']['class']='left-menu-list-submenu';
//            $result['template'] = '<a href="{url}"  data-toggle="collapse" class="'.$this->menuClassName.'"><i></i><span>{label}</span></a>';
            $result['url'] = '#'.$this->module->name."_submenu";
            $result['submenuTemplate'] = '<ul class="{class}" id="{id}">{items}</ul>';
            $result['submenuClass'] = 'left-menu-list list-unstyled';
            $result['submenuId'] = $this->module->name.'_submenu';
            foreach($this->childs as $subItem){
                if(Yii::$app->user->id && !Yii::$app->user->identity->checkPermission($subItem->module->name, 'index')) continue;
                if($subItem->module->status==0) continue;
                $result['items'][]=$subItem->menuItem;
            }
        }

        return $result;
    }
}
