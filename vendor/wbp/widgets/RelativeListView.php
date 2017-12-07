<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 09.06.2015
 * Time: 17:52
 */
namespace wbp\widgets;

use yii\widgets\ListView;

class RelativeListView extends ListView{

    public $relationParameter = "parent";
    public $level=0;

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderItems()
    {
        $this->dataProvider->setPagination(false);

        $rows=[];
        $this->renderLevel($rows,0,0);

        return implode($this->separator, $rows);
    }

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderLevel(&$result,$relationValue,$level)
    {
        $dataProvider=clone $this->dataProvider;
        $dataProvider->query=clone $dataProvider->query;
        $dataProvider->query=$dataProvider->query->andWhere([$this->relationParameter=>$relationValue]);
        $dataProvider->refresh();
        $models = $dataProvider->getModels();
        $keys = $dataProvider->getKeys();
        foreach (array_values($models) as $index => $model) {
            $this->level=$level;
            $result[] = $this->renderItem($model, $keys[$index], $index);
            $this->renderLevel($result,$model->id,$level+1);
        }
    }

}