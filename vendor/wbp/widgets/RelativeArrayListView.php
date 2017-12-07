<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 09.06.2015
 * Time: 17:52
 */
namespace wbp\widgets;

use yii\widgets\ListView;

class RelativeArrayListView extends ListView{

    public $relationParameter = "items";
    public $level=0;

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderItems()
    {
        $this->dataProvider->setPagination(false);

        $rows=[];
        $this->renderLevel($rows,$this->dataProvider->getModels(),0);

        return implode($this->separator, $rows);
    }

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderLevel(&$result,$items,$level)
    {
        foreach ($items as $index => $model) {
            $this->level=$level;
            $result[] = $this->renderItem($model, $keys[$index], $index);
            if(isset($model[$this->relationParameter]))$this->renderLevel($result,$model[$this->relationParameter],$level+1);
        }
    }

}