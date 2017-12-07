<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 09.11.2015
 * Time: 14:17
 */
namespace backend\modules\pages\models;

use common\models\WbpActiveRecord;

class SiteWidgetsAvailableRelation extends WbpActiveRecord{
    public static function tableName(){
        return '{{%pages_widgets_connect}}';
    }

}