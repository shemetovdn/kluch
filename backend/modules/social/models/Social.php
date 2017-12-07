<?php
/**
 * Created by PhpStorm.
 ** User: TrickTrick alexeymarkov.x7@gmail.com
 *** Date: 26.05.2015
 **** Time: 11:20
 */

namespace backend\modules\social\models;

use backend\models\BaseFormModel;


class Social extends BaseFormModel
{
    public
        $name,
        $value;
    public $modelName = 'backend\modules\social\models\SocialDB';

    public function rules()
    {
        return [
            ['value', 'safe', 'on' => ['edit', 'add']]
        ];

    }
}