<?

$this->title= Yii::$app->controller->module->text['add_item'];

    $this->params['breadcrumbs'][] = ['label' => Yii::$app->controller->module->text['module_name'], 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="heading-buttons">
    <h3><?=$this->title?><span> | <?= Yii::$app->controller->module->text['module_name'] ?></span></h3>

    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>

<div class="innerLR">

    <?=$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])?>

</div>
