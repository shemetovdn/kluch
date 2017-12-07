<?=$this->render(
    '@backend/views/parts/edit',
    [
        'title'=>Yii::$app->controller->module->text['edit_item'],
        'form'=>$this->render(Yii::$app->controller->formView, ['formModel' => $formModel, 'formUserModel'=>$formUserModel]),
        'add'=>(true)?Yii::$app->controller->module->text['add_item']:false,          // Add "Add button"
        'delete'=>(true)?$model->id:false,                                                 // Add Remove Button
    ])
?>