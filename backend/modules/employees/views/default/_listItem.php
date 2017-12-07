<?
use common\models\User;
use wbp\widgets\RemoveButton;
use yii\helpers\Html;

?>
    <td class="center"><?=$model->id?></td>
    <td width="15%"><?=$model->username?></td>
    <td ><?=$model->data->first_name?> <?=$model->data->last_name?></td>
    <td width="15%"><?=$model->email?></td>
    <td width="15%"><?=$model->data->phone?></td>
    <td width="15%"><?=User::findOne($model->creator_id)->name?></td>
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
