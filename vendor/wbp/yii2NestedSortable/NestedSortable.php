<?php

namespace wbp\yii2NestedSortable;

use yii;


/**
 * Class NestedSortable
 * @package wbp\yii2NestedSortable
 */
class NestedSortable extends \yii\base\Widget
{
    /**
     * @var int
     */
    public $maxLevels = 2;
    /**
     * @var string
     */
    public $handle = 'div';
    /**
     * @var string
     */
    public $parentItem = 'ol';
    /**
     * @var string
     */
    public $items = 'li';
    /**
     * @var string
     */
    public $toleranceElement = '> div';
    /**
     * @var string
     */
    public $forcePlaceholderSize = "true";
    /**
     * @var string
     */
    public $helper = 'clone';
    /**
     * @var string
     */
    public $cssClass = 'sortable nested_widget_class';
    /**
     * @var array [id*,title*,parent]
     */
    public $insideItems = [
        ["id"=>1,"label"=>"Top Parent content without childrens"],
        ["id"=>2,"label"=>"Top Parent content with childrens", "items"=>
            [
                ["id"=>3,"label"=>"2-nd Parent with childrens","items"=>
                    [
                        ["id"=>4,"label"=>"3-dChildren","items"=>
                            [
                                ["id"=>7,"label"=>"4-dChildren"]
                            ]
                        ],
                        ["id"=>5,"label"=>"Children2"]
                    ],
                ],
                ["id"=>6,"label"=>"2-nd  Parent without childrens"]
            ]
        ]
    ];

    public $labelKeyTitle = 'label';
    public $parentKeyTitle = 'items';
    public $startCollapsed = 'false';
    public $relocateSuccessFunction = 'relocateSuccessFunction';


    private $widgetID;


    /**
     *INIT WIDGET
     */
    public function init()
    {
        $this->widgetID = $this->getId()."_".uniqid();
        $view = $this->getView();
        NestedSortableAsset::register($view);
        $view->registerJs("\$('#".$this->widgetID."').nestedSortable({
            handle: '".$this->handle."',
            items: '".$this->items."',
            toleranceElement: '".$this->toleranceElement."',
            forcePlaceholderSize: '".$this->forcePlaceholderSize."',
            helper:	'".$this->helper."',
            maxLevels: '".$this->maxLevels."',
            startCollapsed: $this->startCollapsed,
            relocate:function(){
                if (typeof $this->relocateSuccessFunction == 'function') {
                    $this->relocateSuccessFunction();
                }
            },
            isTree: true,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            expandOnHover: 700,
        });
        ");
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->insideItemsChecker();
        return yii\helpers\Html::tag(
            $this->parentItem,
            $this->pretifierWorker($this->insideItems),
            [
                'class'=>$this->cssClass,
                'id'=>$this->widgetID
            ]
        );
    }

    private function insideItemsChecker(){
        if(count($this->insideItems) == 0) {
            throw new yii\base\UserException('
            Widget ' . __CLASS__ . ' required insideItems in current format
            (["id"=>2,"title"=>"Top Parent content with childrens", "parent"=>[])
        ');
        }
    }


    /**
     * @param $items
     * @return string
     */
    private function pretifierWorker($items){
        if(is_array($items)){
            foreach($items as $item){
                $itemTag = $this->createHandleTag($item[$this->labelKeyTitle]);
                if(isset($item['items'])){
                    $itemTag .= $this->subItemCreator($item[$this->parentKeyTitle]);
                }
                $return .= $this->createItemsTag($itemTag,$item['id']);
            }
        }
        return $return;
    }

    /**
     * @param $items
     * @return string
     */
    private function subItemCreator($items){
        $return = $this->pretifierWorker($items);

        return yii\helpers\Html::tag(
            $this->parentItem,
            $return
        );
    }

    /**
     * @param $content
     * @return string
     */
    private function createHandleTag($content){
        return yii\helpers\Html::tag($this->handle,$content);
    }

    /**
     * @param $content
     * @param $id
     * @return string
     */
    private function createItemsTag($content,$id){
        return yii\helpers\Html::tag($this->items,$content,['id'=>$this->widgetID."_".$id]);
    }
}