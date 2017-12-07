<?

namespace backend\modules\request\models;

use backend\models\Tags;
use common\models\WbpActiveRecord;

class Request extends WbpActiveRecord{

    public static function tableName()
    {
        return '{{%request}}';
    }

    public function rules()
    {

        return [
            [[
                'fname',
                'phone',
                'email',
                'rent_sale',
                'rent_type',
                'type',
                'message',
                'property_type',
                'rooms',
                'rooms_from',
                'rooms_to',
                'price',
                'price_from',
                'price_to',
                'place'
            ], 'safe'],
            ['fname', 'required', 'message' => 'Пожалуйста укажите Ваше имя'],
            ['phone', 'required', 'message' => 'Пожалуйста укажите Ваш телефон'],
        ];
    }


}