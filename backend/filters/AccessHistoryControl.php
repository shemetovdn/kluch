<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 29.05.2015
 * Time: 15:35
 */

namespace backend\filters;

use backend\models\UserLog;
use common\models\User;
use Yii;
use yii\filters\AccessControl;

class AccessHistoryControl extends AccessControl
{

    public $denyCallback;
    public $permittedActions = ['error', 'forbidden', 'logout', 'login'];
    public $avaliableModulesForAll = ['app-backend', 'moduleCreator'];

    public function beforeAction($action)
    {

        $user = $this->user;
        $result = parent::beforeAction($action);

        if ($result) {
            if (in_array(Yii::$app->controller->module->id, $this->avaliableModulesForAll)) return $result;

            if (in_array($action->id, $this->permittedActions)) return $result;

            $currentUser = Yii::$app->user->identity;//User::findOne(\Yii::$app->user->id);
            $access = $currentUser->checkPermission(\Yii::$app->controller->module->id, $action->id);

            if ($access) {
                $this->addToLog();
                return true;
            }

            $this->addToLog(UserLog::ACCESS_DENIED);
            Yii::$app->controller->actionForbidden();

            return false;
        }
        return $result;

    }

    public function addToLog($additionalOptions = '', $item_id = '')
    {
        if (Yii::$app->request->get('id') && !$item_id) $item_id = Yii::$app->request->get('id');
        $module = Yii::$app->controller->module->id;
        $action = Yii::$app->controller->action->id;
        $attributes = [
            'user_id' => \Yii::$app->user->id,
            'module' => $module,
            'action' => $action,
            'additional_options' => ''
        ];
        if ($item_id) $attributes['item_id'] = $item_id;

        if (is_array($attributes['item_id'])) $attributes['item_id'] = implode('|', $attributes['item_id']);

        if (!$additionalOptions) {
            $lastLog = UserLog::find()
                ->andWhere($attributes)
                ->andWhere(' updated_at > :updated_at ', ['updated_at' => date("Y-m-d H:i:s", time() - 60)])
                ->orderBy('id desc')->one();
        } else {
            $attributes['additional_options'] = $additionalOptions;
        }

        if ($lastLog) $lastLog->save();
        else {
            $log = new UserLog();
            $log->setAttributes($attributes, false);
            $log->save();
        }
        if (Yii::$app->request->post('logOnly'))
            Yii::$app->end();
    }

}