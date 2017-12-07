
<?=$this->render('@backend/views/parts/add',['title'=>Yii::t('admin','Добавить новый город'), 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>
