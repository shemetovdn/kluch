<?
use yii\helpers\Html;

echo $this->render(
    '@backend/views/parts/edit',
    [
        'title'=>'Редактировать новость "'.Html::encode($formModel->title).'"',
        'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel]),
        'add'=>(true)?Yii::t('admin','Add new article'):false,          // Add "Add button"
        'delete'=>(true)?$formModel->id:false,                                                 // Add Remove Button
    ])
?>
