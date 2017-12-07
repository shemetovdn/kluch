<?
use yii\helpers\Html;

$this->title = Yii::$app->controller->module->text['edit_item'];

$this->params['breadcrumbs'][] = ['label' => Yii::$app->controller->module->text['module_name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="heading-buttons">
    <h3><?= $this->title ?><span> | <?= Yii::$app->controller->module->text['module_name'] ?></span></h3>

    <div class="buttons pull-right">
        <?= Html::a('<i></i>' . Yii::$app->controller->module->text['add_item'], ['add'], ['class' => 'btn btn-primary btn-icon glyphicons circle_plus ']) ?>
        <?= \wbp\widgets\RemoveButton::widget([
            'linkOptions' => [
                'text' => '<i></i>Remove',
                'url' => ['remove', 'id' => $formModel->id],
                'options' => ['class' => 'btn btn-default btn-icon glyphicons bin']
            ],
            'ajax' => false
        ]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>

<div class="innerLR">

    <?= $this->render(Yii::$app->controller->formView, ['formModel' => $formModel]); ?>

</div>
