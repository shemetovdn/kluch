<?
    use yii\helpers\Html;

 echo $this->render(
    '@backend/views/parts/edit',
    [
        'title'=>'Редактировать запись '.Html::encode($formModel->first_name).' '.Html::encode($formModel->last_name),
        'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel]),
        'add'=>(true)?'Добавить партнёра':false,          // Add "Add button"
        'delete'=>(true)?$formModel->id:false,                                                 // Add Remove Button
    ])
?>