<?
use yii\helpers\Html;
use wbp\widgets\RemoveButton;
if(!$model->status){ $bg = "background-color: #e69b9b;"; }
?>
<td class="center" style="<?=$bg?>"><?= $model->id ?></td>
<td style="<?=$bg?>width:100px;"><img src="<?= $model->image->getUrl('100x80') ?>" /></td>
<td style="<?=$bg?>"><?= $model->name ?></td>
<td style="<?=$bg?>"><?= $model->username ?></td>
<td style="<?=$bg?>"><?= $model->userData->phone ?></td>
<td width="100" class="center btn-actions" style="<?=$bg?>">

    <? if(Yii::$app->user->identity->is_super_admin){ ?>
        <?= Html::a('Войти', ['/dashboard/default/login-as-user', 'id' => $model->id], ['class' => 'btn btn-info', 'style'=>'width:60px; margin-bottom:5px;', 'data-pjax' => 0]) ?>
    <? } ?>
    <div class="btn-group" aria-label="" role="group" style="">
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
