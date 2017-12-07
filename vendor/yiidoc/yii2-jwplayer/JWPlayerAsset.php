<?php
/**
 * Created by PhpStorm.
 * User: zinzinday
 * Date: 10/30/2014
 * Time: 1:20 AM
 */

namespace yii\jwplayer;
use yii\web\AssetBundle;

class JWPlayerAsset extends AssetBundle
{
    public $sourcePath = '@yii/jwplayer/assets';
    public $js = ['jwplayer.js'];
    public $depends=[
        'yii\web\JqueryAsset'
    ];
} 