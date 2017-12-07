
<?=$this->render(
    '@backend/views/parts/edit',
    [
        'title'=>Yii::t('admin', 'Редактировать пользователя').' "'.$model->name.'"',
        'form'=>$form,
        'add'=>(true)?Yii::t('admin', 'Add new article'):false,          // Add "Add button"
        'delete'=>(true)?$model->id:false,                                                 // Add Remove Button
    ])
?>