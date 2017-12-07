<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 27.05.2015
 * Time: 16:29
 */

namespace backend\models;

use wbp\images\models\Image;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class BaseFormModel extends Model{
    public $modelName;
    public $id;

    public function init(){
        parent::init();

        /**
         *      Set default value on init
         */

        $rules=$this->rules();
        foreach($rules as $rule){
            if($rule[1]=='default'){
                $name=$rule[0];
                if(is_array($name)){
                    foreach($name as $n){
                        $this->{$n}=$rule['value'];
                    }
                }else{
                    $this->{$name}=$rule['value'];
                }
            }
        }
    }

    /**
     * @return ActiveRecord
     *
     *
     */

    public function findModel(){
        $model=null;
        $modelName=$this->modelName;
        if($this->id){
            $model=$modelName::findOne(['id'=>$this->id]);
        }
        if(!$model){
            $model=new $modelName();
        }

        return $model;
    }

    /**
     * @param int $id
     *
     */
    public function loadModel($id=0){
        if(!$id) $id=$this->id;
        else $this->id=$id;

        $model=$this->findModel();
        $this->load($model->getAttributes(),'');

        if(method_exists($this, 'afterLoadModel')) $this->afterLoadModel();
    }

    public function save(){
        if($errors=$this->validate()){
            $model=$this->findModel();

            $model->setAttributes($this->getAttributes(),false);
            //$model->status=Stores::STATUS_ACTIVE;
            if(!$model->creator_id) $model->creator_id=Yii::$app->user->id;

            $model->save();
            $this->id=$model->id;

            $this->clearTmpImages();

            $this->saveUploadedImages($model->id);
            if(method_exists($this, 'afterSave')){
                $this->afterSave();
            }
            return true;
        }else{
//            \Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            return false;
        }
    }

    public function clearTmpImages(){
        // Clear Tmp Images

        $tmpImages=Image::find()->where('item_id=:item_id AND added_date < :added_date ', ['item_id'=>'0', 'added_date'=>time()-172800]);
        foreach($tmpImages->each() as $img){
            $img->delete();
        }
    }

    public function saveUploadedImages($item_id,$limit=false){
        // Save uploaded images
        $types=[];
        $imagesUniques=Yii::$app->request->post('image');
        if(is_array($imagesUniques)){
            foreach($imagesUniques as $unique_id){
                $images=Image::find()->where(['unique_id'=>$unique_id]);
                foreach($images->each() as $img){
                    if(!in_array($img->type,$types)) $types[]=$img->type;
                    $img->item_id=$item_id;
                    $img->save();
                }
            }
        }
        if($limit){
            foreach($types as $type){
                $images=Image::find()->where(['item_id'=>$item_id,'type'=>$type])->orderBy('sort, id desc');
                $currentLimit=0;
                foreach($images->each() as $image){
                    if($currentLimit>=$limit) $image->delete();
                    $currentLimit++;
                }
            }
        }

    }


}