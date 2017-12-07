<?=$this->render(
    '@backend/views/parts/edit',
    [
        'title'=>Yii::t('admin', 'Edit') . ' SEO '.Yii::$app->controller->editedTitle['label'],
        'form'=>$this->render(Yii::$app->controller->formView, ['formModel' => $formModel]),
        'add'=>false,          // Add "Add button"
        'delete'=>false,       // Add Remove Button
    ])
?>