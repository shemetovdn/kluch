<?
use wbp\widgets\RemoveButton;
use yii\helpers\Html;

$level = 0;
if (property_exists($widget, 'level')) $level = $widget->level;
?>
<td class="center"><?= Html::encode($model->id) ?></td>
<td><?= Html::encode($model->title) ?></td>
<td><?= Html::encode(substr(strip_tags($model->category->title), 0, 50)) ?></td>
<td><?= Html::encode(substr(strip_tags($model->objectType->title), 0, 50)) ?></td>
<td class="center">
    <div class="btn-group btn-actions" aria-label="" role="group" style="">
        <a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">
            <i class="icmn-pencil" aria-hidden="true"></i>
        </a>
        <?=RemoveButton::widget([
            'linkOptions'=>[
                'text' => '<i class="icmn-bin" aria-hidden="true"></i>',
                'url' => ['remove','id'=>$model->id],
                'options' => ['class'=>'btn btn-danger']
            ],
            'ajax'=>true
        ]);
        ?>
    </div>
</td>
