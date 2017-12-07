<?
use wbp\widgets\RemoveButton;

?>
    <td class="center"><?=$model->id?></td>
    <td width="15%"><?=$model->module?>/<?=$model->action?></td>
    <td ><?=$model->getMessage()?></td>
    <td ><?=Yii::$app->formatter->asDatetime($model->created_at)?></td>
    <td class="center btn-actions">

            <?=RemoveButton::widget([
                'linkOptions'=>[
                    'text' => '<i class="icmn-bin" aria-hidden="true"></i>',
                    'url' => ['remove','id'=>$model->id],
                    'options' => ['class'=>'btn btn-danger']
                ],
                'ajax'=>true
            ]);
            ?>


    </td>
