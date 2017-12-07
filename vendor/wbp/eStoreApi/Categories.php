<?php

namespace wbp\eStoreApi;

use yii\base\Model;

class Categories extends Model{
    public $id,$title,$description,$href,$status,$parent,$parentCategory,$inner,$imagePath,$thumbPath;

    public function rules()
    {
        return [
            [['id','title','description','href','status','parent','inner','imagePath','thumbPath'],'safe'],
        ];
    }

    static public function getCategories($cache=true){
        $result=[];
        $data=\Yii::$app->eStore->get('categories',$cache);
        if($data){
            foreach((array)$data as $itemData){
                $category=new Categories();
                $category->setData($itemData);
                $result[$category->id]=$category;
            }
            return $result;
        }else{
            return false;
        }
    }

    static public function getCategory($name,$cache=true){
        $result=[];
        $data=\Yii::$app->eStore->get('categories/find-by-name?name='.$name.'&expand=parentCategory',$cache);
        if($data){
            $category=new Categories();
            $category->setData($data);
            return $category;
        }else{
            return false;
        }
    }

    public function getProducts(){
        $data=\Yii::$app->eStore->get('categories/'.$this->id.'?expand=products');
        $products=Products::getProductsFromData($data['products']);
        return $products;
    }

    public function getMainProducts(){
        $data=\Yii::$app->eStore->get('categories/'.$this->id.'?expand=mainProducts');
        $products=Products::getProductsFromData($data['mainProducts']);
        return $products;
    }

    public function setData($data){
        $this->load($data,'');
        if($data['parentCategory']){
            $this->parentCategory=new Categories();
            $this->parentCategory->load($data['parentCategory'],'');
        }
        foreach((array)$data['inner'] as $num=>$innerData){
            $this->inner[$num]=new Categories();
            $this->inner[$num]->setData($innerData);
        }
    }

    public static function getMenu(){
        $categories=Categories::getCategories(false);
        $menu=[];
        foreach((array)$categories as $category){
            self::addMenuItem($menu,$category);
        }
        return $menu;
    }

    public static function addMenuItem(&$menu,$category){
        $item=['label'=>$category->title,'url'=>['category/item','name'=>$category->href]];
        if(count($category->inner)){
            $item['items']=[];
            foreach((array)$category->inner as $cat){
                self::addMenuItem($item['items'],$cat);
            }
        }
        $menu[]=$item;
    }

    public static function addBreadcrumb(&$breadcrumbs,$currentCategory){
        $breadcrumbs[]=['label'=>$currentCategory->title,'url'=>['category/item','name'=>$currentCategory->href]];
        if($currentCategory->parentCategory){
            self::addBreadcrumb($breadcrumbs,$currentCategory->parentCategory);
        }
    }

    public static function getCategoryBreadcrumbs($currentCategory){
        $breadcrumbs=[];
        self::addBreadcrumb($breadcrumbs,$currentCategory);
        $breadcrumbs=array_reverse($breadcrumbs);

        return $breadcrumbs;
    }

}