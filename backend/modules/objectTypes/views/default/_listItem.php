<?
use yii\helpers\Html;
use wbp\widgets\RemoveButton;
if(!$model->status){ $bg = "background-color: #e69b9b;"; }
?>
<td class="center" style="<?=$bg?>"><?= $model->id ?></td>
<td style="<?=$bg?>"><?= $model->title ?></td>
<td width="100" class="center" style="<?=$bg?>">
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
