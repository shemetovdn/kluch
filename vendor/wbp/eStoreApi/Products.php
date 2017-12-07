<?php

namespace wbp\eStoreApi;

use wbp\uniqueOverlay\UniqueOverlay;
use yii\base\Model;

class Products extends Model{
    static public $products=[];

    public $id,$title, $href,$category_id,$parent,$description,$childProducts,$status,$stockQty,
        $description_short,$brand_id,$upc_code,$prices,$minPrice,$maxPrice,$minMemberPrice,$maxMemberPrice, $groupProductsIds,
        $price_policy,$category,$parameters,$availableParameters,$images,$singleProduct, $thumbPath, $relatedProductsIds, $groupImages;

    public function rules()
    {
        return [
            [[
                'id','title', 'href','category_id','parent','description','childProducts','status',
                'description_short','brand_id','upc_code','stockQty',
                'price_policy','category','images','singleProduct','groupProductsIds',
                'thumbPath', 'minPrice', 'maxPrice','relatedProductsIds','groupImages'
            ],'safe'],
        ];
    }

    static public function getProductById($id, $cache=true){
        if(self::$products[$id] && $cache) return self::$products[$id];

        $data=\Yii::$app->eStore->get('products/'.(int)$id.'?expand=category', $cache);
        $products=self::getProductsFromData($data);
        return array_values((array)$products)[0];
    }

    static public function getProductByHref($href, $cache=true){
        $data=\Yii::$app->eStore->get('products/search?href='.$href.'&expand=category', $cache);
        $products=self::getProductsFromData($data);
        return array_values((array)$products)[0];
    }

    static public function getProducts($allProducts=true){
        $result=[];
        if($allProducts)
            $data=\Yii::$app->eStore->get('products');
        else
            $data=\Yii::$app->eStore->get('products/main');

        return self::getProductsFromData($data);

    }

    public static function getProductsFromData($data){
        if($data['id']) $data=array($data);
        if($data['data']) $data=array($data['data']);
        if($data){
            foreach($data as $productData){
                $product=new Products();
                $product->setData($productData);
                $result[$product->id]=$product;
            }

            return $result;
        }else{
            return false;
        }
    }

    public function setData($data){
        $this->load($data, '');

        foreach((array)$data['prices'] as $num=>$priceData){
            $price = new ProductsPrice();
            $price->load($priceData,'');
            $this->prices[$num]=$price;
        }

        foreach((array)$data['parameters'] as $num=>$parameterData){
            $parameter = new ProductsParameter();
            $parameter->load($parameterData,'');
            $this->parameters[$parameterData['id']]=$parameter;
        }

        foreach((array)$data['availableParameters'] as $num=>$parameterData){
            $availableParameters = new CategoryParameter();
            $availableParameters->load($parameterData,'');
            $this->availableParameters[$parameterData['id']]=$availableParameters;
        }
        $tmpCat=new Categories();
        $tmpCat->load($data['category'],'');
        $res=&$tmpCat;
        while(is_array($tmpCat->parentCategory)){
            $cat=new Categories();
            $cat->load($tmpCat->parentCategory,'');
            $tmpCat->parent=$cat;
            $tmpCat=&$tmpCat->parent;
        }
        $this->category=$res;

    }

    public function getPrice(){
        if(!$this->price_policy || $this->price_policy==1){
            $price=false;
            foreach((array)$this->prices as $price){
                if($price->member_price==0 && $price->qty_start!=null) break;
            }
            return $price;
        }elseif($this->price_policy==2){
            $price=false;
            foreach((array)$this->prices as $price){
                if($price->member_price==0 && $price->qty_start==null && $price->qty_end==null) break;
            }
            return $price;
        }
    }

    public function getPriceRange(){
        $result='';
        if($this->minPrice) $result.=\Yii::$app->formatter->asCurrency($this->minPrice);
        if($this->minPrice && $this->maxPrice && $this->minPrice!=$this->maxPrice) $result.=' - ';
        if($this->maxPrice && $this->minPrice!=$this->maxPrice) $result.=\Yii::$app->formatter->asCurrency($this->maxPrice);
        return $result;
    }

    public function getImage(){
        foreach((array)$this->images as $image){
            if($image->id){
                return $image;
            }elseif(!$noImage){
                return false;
            }
        }
    }

    public function getAddToCartHref($class=''){
        if(!$this->singleProduct)
            return UniqueOverlay::widget(['htmlClass'=>$class, 'url'=>['cart/get-paramater-selector','id'=>$this->id]]);
        else
            return "href='".\Yii::$app->urlManager->createUrl(['cart/add-to-cart','id'=>$this->id])."' class='$class'";
    }

    public function getCategoriesList($noUrls=false){
        $result='';
        $cat=$this->category;
        do{
            if($result!='') $cat=$cat->parent;
            if(!$noUrls) $result[\Yii::$app->urlManager->createUrl(['categories/index','id'=>$cat->id])]=$cat->title;
            else $result[]=$cat->title;
        }while($cat->parent);
        return $result;
    }
}