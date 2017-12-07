<?
    $years=[];
    for($i=date("Y");$i<=date("Y")+10;$i++) $years[$i]=$i;
?>
<?=$form->field($model,'paymentSelected')->hiddenInput(['class'=>'selector'])->label(false)?>

<div class="in-card-name">
    <?=$form->field($model,'card_name')->textInput()->label('Cardholder Name',['class'=>'col-md-12'])?>
</div>
<?=$form
    ->field($model,'card_type')
    ->dropDownList($method->card_types)
    ->label('Card Type',['class'=>'col-md-12'])
?>
<div class="in-card-name">
<!--    <div class="in-card-name2"><input type="text" placeholder=""/></div>-->
<!--    <div class="in-card-name2"><input type="text" placeholder=""/></div>-->
<!--    <div class="in-card-name2"><input type="text" placeholder=""/></div>-->
<!--    <div class="in-card-name2"><input type="text" placeholder=""/></div>-->
    <?=$form->field($model,'card_number')->textInput()->label('Cardholder Number',['class'=>'col-md-12'])?>
</div>

<div class="in-card-name3">
    <?=$form->field($model,'card_month')->dropDownList([
                    'Month',
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                    '07',
                    '08',
                    '09',
                    '10',
                    '11',
                    '12',
    ],['class'=>'chzn-select','style'=>'width:100%;'])->label('Expiry',['class'=>'col-md-12'])?>
</div>
<div class="in-card-name4">
    <?=$form->field($model,'card_year')->dropDownList(\yii\helpers\ArrayHelper::merge([
        'Year'
    ],$years),['class'=>'chzn-select','style'=>'width:100%;'])->label('&nbsp;',['class'=>'col-md-12'])?>
</div>
<div class="cvv-code">CVV Code</div>
<div class="in-card-name5">
    <?=$form->field($model,'card_cvv')->textInput()->label(false)?>
</div>
<div style="clear:both; height:27px;"></div>