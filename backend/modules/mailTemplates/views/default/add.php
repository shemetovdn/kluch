<?

$this->title='Add New Mail template';

    $this->params['breadcrumbs'][] = ['label' => 'Mail Templates', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="heading-buttons">
    <h3><?=$this->title?><span> | Mail Templates</span></h3>

    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>

<div class="innerLR">

    <?=$this->render(Yii::$app->controller->formView,['formModel'=>$formModel])?>

</div>
