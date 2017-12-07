
<?=$this->render('@backend/views/parts/add',['title'=>'Добавить тип недвижимости', 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>
