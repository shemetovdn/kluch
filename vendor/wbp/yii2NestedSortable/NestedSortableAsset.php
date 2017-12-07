<?php

/**
 * @link http://www.datacentrix.org/
 * @package yii2-nested-sortable
 * @copyright Copyright (c) 2015 Data Centrix Ltd
 * @license GPL-3.0
 * @see LICENSE
 * @version 1.0
 */

namespace wbp\yii2NestedSortable;
use yii\web\AssetBundle;

/**
 * Asset bundle for NestedSortable Widget
 *
 * @author Stanimir Stoyanov <stanimir@datacentrix.org>
 * @since 1.0
 */
class NestedSortableAsset extends AssetBundle
{
    public $sourcePath = '@wbp/yii2NestedSortable/assets';
    public $js = [
        'nested-sortable.js'
    ];
    public $css = [
        'nested-sortable.css'
    ];
    public $depends = [
        'yii\jui\JuiAsset',
    ];
}