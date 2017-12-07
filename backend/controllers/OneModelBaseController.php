<?php
namespace backend\controllers;

use backend\models\UserLog;
use frontend\models\Category;
use wbp\images\models\Image;
use Yii;

/**
 * Site controller
 */
class OneModelBaseController extends BaseController
{
    const ADD_SCENARIO_NAME = 'admin-add';
    const UPDATE_SCENARIO_NAME = 'admin-update';

    /**
     * Экшн добавления элемента
     * @return string|\yii\web\Response
     */

    public function actionAdd(){
        $this->trigger(self::BEFORE_ADD);                                                   // Вызываем события
        $this->trigger(self::BEFORE_ADD_EDIT);

        $modelName = $this->ModelName;                                                        // Находим имя нашей модели

        $formModel = new $modelName(['scenario' => self::ADD_SCENARIO_NAME]);                 // создаем модель с сценарием добавления

        if($formModel->load(Yii::$app->request->post())) {                                  // пытаемся загрузить данные из поста
            $this->clearTmpImages();
            if($formModel->save()){                                                         // сохраняем данные в БД
                $this->addToLog(UserLog::ADDED,$formModel->id);                             // добавляем в лог событие
                Yii::$app->getSession()->setFlash('success', $this->successAddMessage);     // добавляем всплывающее сообщение
                return $this->redirect(['edit','id'=>$formModel->id]);                      // редиректим на редактирование элемента
            }else{
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);            // Если что-то пошло не так, тогда сообщение об ошибке
            }
        }

        return $this->render($this->addView,['formModel'=>$formModel]);                     // рендрим вьюшку добавления элемента
    }

    /**
     *
     * @param $id
     * @return string
     */

    public function actionEdit($id){
        $this->trigger(self::BEFORE_EDIT);
        $this->trigger(self::BEFORE_ADD_EDIT);

        $modelName=$this->ModelName;

        $formModel=$modelName::findOne(['id'=>(int)$id]);
        $formModel->scenario=self::UPDATE_SCENARIO_NAME;

        if($formModel->load(Yii::$app->request->post())){
            $this->clearTmpImages();
            $saved=$formModel->save();
            if($saved){
                $this->addToLog(UserLog::SAVED, $formModel->id);
                Yii::$app->getSession()->setFlash('success', $this->successEditMessage);
            }else{
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            }
        }

        return $this->render($this->editView,['formModel'=>$formModel]);

    }

    public function clearTmpImages(){
        // Clear Tmp Images

        $tmpImages=Image::find()->where('item_id=:item_id AND added_date < :added_date ', ['item_id'=>'0', 'added_date'=>time()-172800]);
        foreach($tmpImages->each() as $img){
            $img->delete();
        }
    }
}
