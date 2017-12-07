<?
use yii\helpers\Html;

$this->title='Edit Mail Templates';

    $this->params['breadcrumbs'][] = ['label' => 'Mail Template', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="heading-buttons">
    <h3><?=$this->title.' "'.Html::encode($formModel->title).'"'?><span> | Mail Template</span></h3>

    <div class="buttons pull-right">
        <?=Html::a('<i></i>Add new mail template', ['add'],['class'=>'btn btn-primary btn-icon glyphicons circle_plus '])?>
        <?=\wbp\widgets\RemoveButton::widget([
            'linkOptions'=>[
                'text' => '<i></i>Remove',
                'url' => ['remove','id'=>$formModel->id],
                'options' => ['class'=>'btn btn-default btn-icon glyphicons bin']
            ],
            'ajax'=>false
        ]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>

<div class="innerLR">

    <?=$this->render(Yii::$app->controller->formView,['formModel'=>$formModel]);?>

</div>
