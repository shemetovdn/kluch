<?
use wbp\widgets\RemoveButton;
use yii\helpers\Html;

?>


<td class="center"><?= $model->id ?></td>
<td><?= Html::encode($model->fname)  ?></td>
<td><?= Html::encode($model->email) ?></td>
<td><?= Html::encode($model->phone) ?></td>
<td class="center" style="width: 180px;"><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
<td class="center" style="width: 100px;">
    <div class="btn-group btn-actions" aria-label="" role="group" style="width: 100px;">

    <?= \backend\widgets\ChangerStatus::widget([
        'action' => ['change-unread-to-read', 'id' => $model->id],
        'field' => 'read',
        'id' => $model->id,
        'className' => \backend\modules\contacts\models\Contacts::className(),
        'title' => 'read/unread',
    ]); ?>

    <a <?=\wbp\uniqueOverlay\UniqueOverlay::widget([
        'htmlClass'=>'btn btn-success',
        'url'=>['contacts/default/popup', 'id' => $model->id]
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
