<?php

namespace yii2masonry;

use yii\base\Widget as Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/**
 * this widget allows you to include a pinterest like layout container to your site
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 *
 */

class yii2masonry extends Widget
{

    /**
    * @var array the HTML attributes (name-value pairs) for the field container tag.
    * The values will be HTML-encoded using [[Html::encode()]].
    * If a value is null, the corresponding attribute will not be rendered.
    */
    public $options = array();


    /**
    * @var array all attributes that be accepted by the plugin, check docs!
    */
    public $clientOptions = array(
        'itemSelector' => '.item',
        'columnWidth'  => 200
    );

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        //checks for the element id
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        echo Html::beginTag('div', ['id' => $this->options['id'],'class'=>'js-masonry']); //opens the container
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::endTag('div'); //closes the container, opened on init
        $this->registerPlugin();
    }

    /**
    * Registers a specific dhtmlx widget and the related events
    * @param string $name the name of the dhtmlx plugin
    */
    protected function registerPlugin()
    {
        $id = $this->options['id'];

        //get the displayed view and register the needed assets
        $view = $this->getView();
        yii2masonryAsset::register($view);

        $js = array();
        
        $options = Json::encode($this->clientOptions);
        $js[] = "var mscontainer$id = document.querySelector('#$id');";
        $js[] = "var msnry$id = new Masonry( mscontainer$id, $options);";
        
        $view->registerJs(implode("\n", $js),View::POS_READY);
    }

}
