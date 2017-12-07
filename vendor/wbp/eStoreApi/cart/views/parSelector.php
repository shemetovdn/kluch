<?php
use yii\helpers\Html;

$pJaxid=uniqid('parSel_');

    echo Html::beginTag('div',['id'=>$pJaxid,'style'=>'position:relative;']);

        echo Html::beginForm();

            echo Html::tag('h2', 'Select product parameters');
            echo Html::tag('hr');

            foreach($paramsSelectors as $id=>$param){
                echo Html::beginTag('div');
                echo Html::label($param['title']);
                echo ' ';

                echo Html::dropDownList('par['.$id.']',$selected[$id],\yii\helpers\ArrayHelper::merge([''=>'Select'],$param['value']),['id'=>'par_'.$id]);
                echo Html::endTag('div');
            }
            if($selectedProductId){
                echo '<div style="clear:both;height:20px;"></div>';
                echo $selectedProduct->title.' - '.$selectedProduct->price.'$';
                echo '<div style="clear:both;height:20px;"></div>';
                echo Html::a('<i></i>Add to cart',['cart/add-to-cart','id'=>$selectedProductId],['class'=>'btn btn-block btn-primary btn-icon glyphicons shopping_cart', 'encode'=>false, 'style'=>'width:150px;color:#fff;']);
            }

        echo Html::endForm();

    echo Html::endTag('div');

    echo '
        <script>
            $("#'.$pJaxid.' select").change(function(){
                $("#'.$pJaxid.'").prepend("<div style=\'position:absolute; background: #fff; opacity: 0.3;width:100%; height:100%;\'></div>")
                $.ajax({
                    data: $("#'.$pJaxid.' form").serialize(),
                    url:$("#'.$pJaxid.' form").attr("action"),
                    type: "GET",
                    success:function(data){
                        $("#ajaxOverlayResult").html(data);
                    }
                });
            });
        </script>
    ';

    if(!$selected) echo \wbp\uniqueOverlay\UniqueOverlay::script();
