<?
    $country_id=uniqid('country_id_');
    $state_id=uniqid('state_id_');

    $this->registerJs(/** @lang text */
        '
            $("#check").on("change", function(){
                if($(this).prop("checked")) $("#shippingForm").addClass("hidden");
                else $("#shippingForm").removeClass("hidden");
            }).change();
    ', \yii\web\View::POS_END);
?>

<div class="l-sh-dawn"><?=$title?></div>
<div class="r-sh-dawn"><a class="edit-icon">EDIT</a></div>
<div style="clear:both; height:10px;"></div>
<? if($isShippingAddress){ ?>
    <?=$form->field($formModel, 'sameAsBilling')->checkbox(['id'=>'check'])->label("Same as Billing Address",["style"=>"color:#7b7b7b;"])?>
    <div style="clear:both; height:10px;"></div>
    <div id="shippingForm">
<? } ?>
<br>
<?
echo $form->field($formModel, 'address')->textInput(['placeholder' => 'Address']);
echo $form->field($formModel, 'address1')->textInput(['placeholder' => 'Address 2'])->label('Address 2');

echo $form->field($formModel, 'country_id')
    ->dropDownList(\yii\helpers\ArrayHelper::merge([0 => 'Select country...'], \wbp\eStoreApi\system\models\Countries::getCountriesListFromJson()), ['id' => $country_id]);

echo $form->field($formModel, 'state_id')->widget(\kartik\depdrop\DepDrop::className(), [
    'options'=>['id'=>$state_id],
    'pluginOptions' => [
        'depends' => [$country_id],
        'placeholder' => 'Select state...',
        'initialize'=>true,
        'url' => \yii\helpers\Url::to(['site/get-regions'])
    ]
]);
$this->registerJs('
    var state_'.$state_id.'="'.$formModel->state_id.'";
    $("#'.$state_id.'").on(\'depdrop.afterChange\', function () {
        if(state_'.$state_id.'){
            $(this).val(state_'.$state_id.');
            state_'.$state_id.'="";
        }
    });
',\yii\web\View::POS_END);

echo $form->field($formModel, 'city')->textInput(['placeholder' => 'City']);
echo $form->field($formModel, 'zip')->textInput(['placeholder' => 'Zip']);

if($isShippingAddress) echo '</div>';
?>
