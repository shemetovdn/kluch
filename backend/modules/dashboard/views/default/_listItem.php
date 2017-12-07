<?
?>

<tr>
    <td>
        <span class="date"><?= date("d/m H:i:s", strtotime($model->created_at)) ?></span>
        <span class="glyphicons activity-icon <?= $model->getIcon() ?>"><i></i></span>
        <span class="ellipsis"><?= $model->getMessage() ?></span>
    </td>
</tr>
