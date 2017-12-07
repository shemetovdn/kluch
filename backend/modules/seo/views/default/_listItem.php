<?
use yii\helpers\Html;

$level=0;
    if(property_exists($widget,'level')) $level=$widget->level;
?>
    <td class="center"><?=Html::encode($model['id'])?></td>
    <td><?=str_repeat('&nbsp;',$widget->level*9)?><?=Html::encode($model['label'])?></td>
    <td class="center btn-actions">
        <? if($model['url']){ ?>
            <a href="<?=\yii\helpers\Url::to($model['url'])?>" class="btn btn-success">
                <i class="icmn-pencil" aria-hidden="true"></i>
            </a>
        <? } ?>
    </td>
