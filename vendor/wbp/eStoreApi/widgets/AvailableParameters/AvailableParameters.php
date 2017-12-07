<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2/1/2016
 * Time: 13:35
 */

namespace wbp\eStoreApi\widgets\AvailableParameters;


use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

class AvailableParameters extends Widget
{
    public $product,$parameters;

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        $this->registerScript();

        echo Html::beginTag('div',['id'=>$this->id,'class'=>'availableParams']);
        echo Html::hiddenInput('availableProducts','');

        foreach ((array)$this->product->availableParameters as $availableParameter) {
            $name='\wbp\eStoreApi\widgets\AvailableParameters\AvailableParameter';
            $type=$this->parameters[strtolower($availableParameter->title)]['type'];
            if($type) $name.=ucfirst($type);
            else $name.='Select';



            echo $name::widget([
                'parameter'=>$availableParameter
            ]);

        }

        echo Html::endTag('div');

    }

    public function registerScript(){
        $script=<<<JS

            function getAvailableProducts(inputs){
                 var availableProducts=[];

                inputs.each(function(){
                    var products=[];
                    if($(this).val()) products=$(this).val().split(",");


                    if(availableProducts.length==0 && products.length>0){
                        availableProducts=products;
                    }else if(products.length>0){
                        availableProducts=Intersection(availableProducts,products);
                    }

                });

                return availableProducts;
            }

            function disableWronsParams(){

                availableProducts=getAvailableProducts(
                        $("#{$this->id}").find('input[name^=products]')
                );
                $("#{$this->id} [name=availableProducts]").val(availableProducts.join(","));
                $("#{$this->id} [name=availableProducts]").change();

                setDisabledImages();
                setDisabledSelects();
            }

            function setDisabledSelects(){
                $(".selectWidget select").each(function(){

                    availableProducts=getAvailableProducts(
                        $("#{$this->id}")
                        .find('input[name^=products]').not(
                            $(this).parents(".selectWidget").find('input[name^=products]')
                        )
                    );

                    $(this).find('option').each(function(){
                        if($(this).val()=='') return;
                        var found=false;

                        if(availableProducts.length==0) found=true;

                        var thisProducts=[];
                        if($(this).data('products')) thisProducts=String($(this).data('products')).split(",");

                        var inters=Intersection(availableProducts,thisProducts);

                        if(inters.length) found=true;

                        if(!found) $(this).attr('disabled','disabled');
                        else{
                            $(this).attr('disabled','');
                            $(this).removeAttr('disabled');
                        }
                    });
                    var opts=$(this).find('option').not($(this).find('option[disabled]'))
                    if(opts.length<=2){
                        $(this).val(opts.last().attr('value'));
                    }

                    $(this).trigger("liszt:updated")

                })
            }

            function setDisabledImages(){
                $(".colorsWidget").each(function(){
                    //if(!$(this).find('.value').val()) return;

                    availableProducts=getAvailableProducts(
                        $("#{$this->id}")
                        .find('input[name^=products]').not(
                            $(this).find('input[name^=products]')
                        )
                    );

                    $(this).find('.color-choose').each(function(){
                        var found=false;

                        if(availableProducts.length==0) found=true;

                        var thisProducts=[];
                        if($(this).data('products')) thisProducts=String($(this).data('products')).split(",");

                        var inters=Intersection(availableProducts,thisProducts);

                        if(inters.length) found=true;

                        if(!found) $(this).addClass('disabled');
                        else{
                            $(this).removeClass('disabled');
                        }
                    });
                })
            }

            function Intersection(A,B)
            {
                var M=A.length, N=B.length, C=[];
                for (var i=0; i<M; i++)
                 { var j=0, k=0;
                   while (B[j]!==A[i] && j<N) j++;
                   while (C[k]!==A[i] && k<C.length) k++;
                   if (j!=N && k==C.length) C[C.length]=A[i];
                 }
               return C;
            }

JS;

        $this->view->registerJs($script, View::POS_END);
    }


}