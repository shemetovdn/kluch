
<?php
    $formModel->category_id = Yii::$app->request->get('category_id');
    $formModel->object_type_id = Yii::$app->request->get('object_type_id');
?>

<?=$this->render('@backend/views/parts/add',['title'=>Yii::$app->controller->module->text['add_item'], 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>