<?
use wbp\widgets\RemoveButton;
use yii\helpers\Html;
use backend\modules\agents\models\Agents;

$isAgent = false;
$userId = \Yii::$app->user->identity->id;
if(Agents::getById($userId)->role == 10){
    $isAgent = true;
    $userName = Agents::getById($model->agent_id)->username;
    if($model->agent_id == 0) $userName = 'Pavel';
}

?>


<td class="center"><?= $model->id ?></td>
<? if ($isAgent) {?>
    <td class="center">
        <?=$userName?>
    </td>
<?}?>
<td><?= Html::encode($model->fname)  ?></td>
<td class="center"><?= Html::encode($model->phone) ?></td>
<td class="center"><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
<td class="center" style="width: 100px;">
    <div class="btn-group btn-actions" aria-label="" role="group" style="width: 100px;">

        <?= \backend\widgets\ChangerStatus::widget([
            'action' => ['change-unread-to-read', 'id' => $model->id],
            'field' => 'read',
            'id' => $model->id,
            'className' => \backend\modules\agentscallback\models\Agentscallback::className(),
            'title' => 'read/unread',
        ]); ?>

        <a <?=\wbp\uniqueOverlay\UniqueOverlay::widget([
            'htmlClass'=>'btn btn-success',
            'url'=>['agentscallback/default/popup', 'id' => $model->id]
        ])?>><i class="icmn-pencil"></i></a>



        <!--        <a href="--><?//=\yii\helpers\Url::to(['edit','id'=>$model->id])?><!--" class="btn btn-success">-->
        <!--            <i class="icmn-pencil" aria-hidden="true"></i>-->
        <!--        </a>-->
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
