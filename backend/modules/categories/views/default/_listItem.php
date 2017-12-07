<?
use wbp\widgets\RemoveButton;
use yii\helpers\Html;

$level = 0;
if (property_exists($widget, 'level')) $level = $widget->level;
?>
<td class="center"><?= Html::encode($model->id) ?></td>
<td><?= Html::encode($model->title) ?></td>
<td class="center">

    <?= Html::a('<i></i>', ['edit', 'id' => $model->id], ['class' => 'btn-action glyphicons pencil btn-success', 'data-pjax' => 0]) ?>
    <?= RemoveButton::widget([
        'linkOptions' => [
            'text' => '<i></i>',
            'url' => ['remove', 'id' => $model->id],
            'options' => ['class' => 'btn-action glyphicons remove_2 btn-danger']
        ],
        'ajax' => true
    ]);
    ?>


</td>
