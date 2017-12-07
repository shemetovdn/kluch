<?php
namespace backend\models;

use backend\modules\stores\models\Stores;
use common\models\WbpActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Addresses extends WbpActiveRecord
{
    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    const SHIPPING_ADDRESS_TYPE = 1;
    const SHIPPING_ADDRESS_TYPE_NAME = 'shipping';
    const BILLING_ADDRESS_TYPE = 0;
    const BILLING_ADDRESS_TYPE_NAME = 'billing';


    public static $imageTypes=[];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%addresses}}';
    }

    public function fields(){
        return [
            'id',
            'country_id',
            'state_id',
            'city',
            'address',
            'address1',
            'zip',
            'country',
            'state',
            'type',
            'typeName'=>function(){
                if($this->type == self::SHIPPING_ADDRESS_TYPE){
                    return self::SHIPPING_ADDRESS_TYPE_NAME;
                }elseif($this->type == self::BILLING_ADDRESS_TYPE){
                    return self::BILLING_ADDRESS_TYPE_NAME;
                }else{
                    return 'Undefined Address type ['.$this->type.']';
                }
            }
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviours=parent::behaviors();

        return ArrayHelper::merge($behaviours,[
            TimestampBehavior::className(),
        ]);
    }

    public function loadWithPrefix($attributes,$prefix=''){
        foreach($this->safeAttributes() as $attribute){
            if(isset($attributes[$prefix.$attribute])) $this->$attribute=$attributes[$prefix.$attribute];
        }
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getState(){
        return $this->hasOne(Regions::className(), ['id' => 'state_id']);
    }

    public function get($format='%a %A, %c, %r, %C %z'){
        return str_replace(
            [
                '%a',
                '%A',
                '%c',
                '%r',
                '%s',
                '%C',
                '%z'
            ],
            [
                $this->address,
                $this->address1,
                $this->city,
                $this->state,
                $this->state,
                $this->country,
                $this->zip
            ],
            $format
        );

    }

    public function rules()
    {
        return [
            [
                [
                    'address','address1','country_id','state_id','city','zip','type'
                ],
                'safe'],
        ];
    }


    /**
     * check access to this address from current store
     * @return bool
     */
    public function checkAccess(){
        return true;
    }


}
