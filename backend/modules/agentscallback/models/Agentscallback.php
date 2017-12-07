<?

namespace backend\modules\agentscallback\models;

use backend\models\Tags;
use common\models\WbpActiveRecord;
use backend\modules\agents\models\Agents;

class Agentscallback extends WbpActiveRecord{

    public static function tableName()
    {
        return '{{%agents_callback}}';
    }

    public function rules()
    {
        return [
            [['fname', 'phone', 'agent_id', 'message', 'property_id'], 'safe'],
            [['fname', 'phone'], 'required', 'message' => 'Это обязательное поле'],
        ];
    }
}