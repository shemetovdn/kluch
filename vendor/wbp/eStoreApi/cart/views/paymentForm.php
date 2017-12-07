<?
use yii\helpers\Html;

$this->registerJs("
        document.forms.autoRedirect.submit();
    ",\yii\web\View::POS_READY);
?>

<?=Html::beginForm($data['formAction'],'post',['name'=>'autoRedirect'])?>

<?
    echo "<center>Please wait while being transferred to Payment website.<br>If the Payment website will not open within 10 seconds, click on this button:<br>";

    foreach($data['formData'] as $name=>$value){
        echo Html::hiddenInput($name,$value);
    }

    echo Html::submitButton();
?>

<?=Html::endForm()?>
