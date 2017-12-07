<?php

namespace wbp\widgets;

use yii\helpers\Json;
use yii\web\View;

class MaskedInput extends \yii\widgets\MaskedInput{
    protected function hashPluginOptions($view)
    {
        $encOptions = empty($this->clientOptions) ? '{}' : Json::encode($this->clientOptions);
        $this->_hashVar = self::PLUGIN_NAME . '_' . hash('crc32', $encOptions);
        $this->options['data-plugin-name'] = self::PLUGIN_NAME;
        $this->options['data-plugin-options'] = $this->_hashVar;
        $view->registerJs("var {$this->_hashVar} = {$encOptions};\n", View::POS_END);
    }
}

