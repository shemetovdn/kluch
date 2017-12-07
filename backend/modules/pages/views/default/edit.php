<?
use yii\helpers\Html;

echo $this->render(
    '@backend/views/parts/edit',
    [
        'title'=>Yii::t('admin', 'Edit Page').' "'.Html::encode($model->title).'"',
        'form'=>$form,
        'add'=>(true)?Yii::t('admin', 'Add New Page'):false,          // Add "Add button"
        'delete'=>(true)?$model->id:false,                                                 // Add Remove Button
    ])
?>
