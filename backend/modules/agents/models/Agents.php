<?php
namespace backend\modules\agents\models;

use backend\models\Modules;
use backend\modules\employees\models\Employee;
use common\models\UserData;
use common\models\UserPermissions;
use Yii;


/**
 * @property int $id
 * @property int $title
 * @property int $key
 * @property int $url
 */
class Agents extends Employee
{
    const AGENT_ROLE=11;
    public static $imageTypes = ['agent'];
    public  $first_name;
    public  $last_name;
    public  $phone;
    public  $information;

    public $merchant_ids;

    public $modulesAvailable=[
        62=>[1,2,3,4],
        73=>[1,2,3,4],
        76=>[1,2,3,4],
    ];

    public $relationFields=[
        'data'=>[
            'first_name',
            'last_name',
            'information',
            'phone'
        ]
    ];

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'first_name', 'last_name', 'phone', 'information', 'merchant_ids'], 'safe'],
            [['password'], 'required', 'on' => [self::ADMIN_ADD_SCENARIO]],
            ['username', 'required', 'on' => [self::ADMIN_EDIT_SCENARIO,self::ADMIN_ADD_SCENARIO]],
            ['username', function ($attribute, $params) {
                if (!ctype_alnum($this->$attribute)) {
                    $this->addError($attribute, 'The store name must contain letters or digits.');
                }
            }],
//            ['username', function ($attribute, $params) {
//                $user=User::find()->where(['username'=>$this->$attribute]);
//                if($this->id) $user=$user->andWhere(['!=','id',$this->id]);
//                if ($user->count()) {
//                    $this->addError($attribute, 'You can\'t use this username, please use another.');
//                }
//            }, 'on' => ['edit', 'add']],
//            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This store name has already been taken.', 'on' => 'add'],
        ];
    }

    public function beforeSave($insert)
    {
        $this->parent=Yii::$app->user->id;
        if(!$this->role)
            $this->role=self::AGENT_ROLE;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function attachDefaultPermissions(){
        $agentLinks=UserPermissions::find()->where(['user_id'=>$this->id])->all();
        foreach ($agentLinks as $link) $link->delete();

        $modules=Modules::find()->where(['id'=>array_keys($this->modulesAvailable)])->all();
        foreach ($modules as $module){

            $permissions=$module->getPermissions();
            if(count($this->modulesAvailable[$module->id])){
                $permissions=$permissions->andWhere(['id'=>$this->modulesAvailable[$module->id]]);
            }
            foreach ($permissions->all() as $permission){
                $link=new UserPermissions();
                $link->user_id=$this->id;
                $link->permission_id=$permission->id;
                $link->module_id=$module->id;
                $link->store_id=1;
                $link->save();
            }
        }
    }

    public function afterFind(){
//        foreach ($this->userMerchants as $link){
//            $this->merchant_ids[]=$link->merchant_id;
//        }
    }

    public function afterSave($insert, $changedAttributes)
    {

        // User Data
        $agent = UserData::findOne(['user_id' => $this->id]);
        $userdata = Yii::$app->request->post("UserData");
        if(!$userdata){
            $userdata = Yii::$app->request->post("Agents");
        }


        if($agent){
            $agent->first_name = $userdata['first_name'];
            $agent->last_name = $userdata['last_name'];
            $agent->phone = $userdata['phone'];
            $agent->information = $userdata['information'];
            $agent->save();
        }else{
            $agent = new UserData();
            $agent->first_name = $userdata['first_name'];
            $agent->last_name = $userdata['last_name'];
            $agent->phone = $userdata['phone'];
            $agent->information = $userdata['information'];
            $agent->user_id = $this->id;
            $agent->save();
        }
        $this->attachDefaultPermissions();

        return parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }



    public static function find()
    {
        return parent::find()->andWhere(['role'=>self::AGENT_ROLE]); // TODO: Change the autogenerated stub
    }

    public static function getById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    public function getPassword(){
        return false;
    }
    public function getUserData()
    {
        return $this->hasOne(UserData::className(), ['user_id' => 'id']);
    }

    public static function getAgentsArray()
    {
        $result = [];
        $items = Agents::find();
        $items = $items->orderBy("id desc")->all();

        foreach ($items as $item) {
            $result[$item->id] = $item->userData->first_name." ".$item->userData->last_name."(".$item->username.")";//.'&nbsp;';
        }
        return $result;
    }

}