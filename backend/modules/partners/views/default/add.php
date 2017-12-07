
<?=$this->render('@backend/views/parts/add',['title'=>'Добавить партнёра', 'form'=>$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])])?>