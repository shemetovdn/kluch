
<?=$this->render('@backend/views/parts/add',['title'=>Yii::t('admin','Add New Service'), 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>