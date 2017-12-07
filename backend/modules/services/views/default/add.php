
<?=$this->render('@backend/views/parts/add',['title'=>'Добавить новую услугу', 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>