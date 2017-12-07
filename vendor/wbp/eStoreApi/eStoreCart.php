<?php

namespace wbp\eStoreApi;

use backend\modules\discount\models\Discounts;
use backend\modules\orders\models\Order;
use wbp\eStoreApi\system\models\Address;
use yii\base\Component;

class eStoreCart extends Component
{
    public $beforeCurrencySing='$';
    public $afterCurrencySing='';
    public $currencyFactor=1;


    private $products = [];
    public $shippingAddress, $billingAddress, $payment,$discount;
    public $tmpCart = false;
    private $order_id;


    public function init()
    {
        $this->unSerializeCart();
    }

    public function getSubTotal()
    {
        $subtotal = 0;
        foreach ($this->getProducts() as $product) {
            $subtotal += $product->getSubTotalPrice();
        }
        return number_format($subtotal, 2, '.', '');
    }

    public function getTotal()
    {
        $total = 0;
        $total += $this->getSubTotal();

        if($this->discount)$total -= $this->discount->calcDiscount($total);

        return number_format($total, 2, '.', '');
    }

    public function getCountProducts()
    {
        return count($this->getProducts());
    }

    public function getProducts()
    {
        if (!$this->products) return [];
        return $this->products;
    }

    public function clear()
    {
        $this->products = [];
        $this->shippingAddress = null;
        $this->billingAddress = null;
        $this->order_id = null;

        $this->serializeCart();
    }

    public function setShippingAddress(Address $address)
    {
        $this->shippingAddress = $address;
    }

    public function setPayment($payment, $payment_method)
    {
        $this->payment_method = $payment_method;
        $this->payment = $payment;
    }

    public function setBillingAddress(Address $address)
    {
        $this->billingAddress = $address;
    }

    public function add($_product, $qty = 1, $price = null)
    {
        $prd = new eStoreCartProduct();

        if ($price!==null) {
            $prd->setPrice($price);
        }

        $prd->product = $_product;
        $prd->id = $_product->id;
        $prd->qty = $qty;
        $this->products[] = $prd;
    }

    public function addProduct($_product, $qty = 1, $price = null)
    {
        $product = $this->findProduct($_product);
        if ($product) {
            if ($qty <= 0) {
                unset($product);
            } else {
                $product->increaseQty($qty);
            }
        } else {
            if ($qty >= 1) {
                $this->add($_product, $qty, $price);
            }
        }

        $this->serializeCart();
    }


    public function updateProduct($_product, $qty = 1, $price = null)
    {
        $product = $this->findProduct($_product);

        if ($product) {
            if ($qty > 0) {
                $product->setQty($qty);
            }
        } else {
            if ($qty >= 1) {
                $this->add($_product, $qty, $price);
            }
        }

        $this->serializeCart();
    }

    public function removeProduct($_product)
    {
        if ($this->products) {
            foreach ((array)$this->products as $num => $product) {
                if ($product->id == $_product->id) unset($this->products[$num]);
            }
        }

        $this->serializeCart();
    }

    public function findProduct($_product)
    {
        if ($this->products) {
            foreach ((array)$this->products as $num => $product) {
                if ($product->id == $_product->id) return $this->products[$num];
            }
        }
        return false;
    }

    protected function serializeCart()
    {
        if ($this->tmpCart) return;
        $eStoreCart['products'] = serialize($this->products);
        $eStoreCart['discount'] = serialize($this->discount);
        \Yii::$app->session->set('eStoreCart', $eStoreCart);
    }

    protected function unSerializeCart()
    {
        if ($this->tmpCart) return;
        $eStoreCart = \Yii::$app->session->get('eStoreCart');
        $this->products = unserialize($eStoreCart['products']);
        if(isset($eStoreCart['discount']))$this->discount = unserialize($eStoreCart['discount']);
    }

    public function order()
    {
        $productsArray = [];
        $products = $this->getProducts();
        foreach ($products as $product) {


            $productsArray[] = ['product_id' => $product->id, 'qty' => $product->qty];
        }

        if(\Yii::$app->user->id){

            $userArray=[
                'client_id'=>\Yii::$app->user->id,
                'first_name'=>\Yii::$app->user->identity->first_name,
                'last_name'=>\Yii::$app->user->identity->last_name,
                'phone'=>\Yii::$app->user->identity->phone,
                'email'=>\Yii::$app->user->identity->email,
            ];

        }else{
            $userArray=[
                'client_id'=>0,
                'first_name'=>$this->shippingAddress->first_name,
                'last_name'=>$this->shippingAddress->last_name,
                'phone'=>$this->shippingAddress->phone,
                'email'=>$this->shippingAddress->email,
            ];
        }

        $shippingArray = [
            'address' => $this->shippingAddress->address,
            'address1' => $this->shippingAddress->address1,
            'country_id' => $this->shippingAddress->country_id,
            'state_id' => $this->shippingAddress->state_id,
            'city' => $this->shippingAddress->city,
            'zip' => $this->shippingAddress->zip
        ];

        if($this->billingAddress){
            $billingArray = [
                'address' => $this->billingAddress->address,
                'address1' => $this->billingAddress->address1,
                'country_id' => $this->billingAddress->country_id,
                'state_id' => $this->billingAddress->state_id,
                'city' => $this->billingAddress->city,
                'zip' => $this->billingAddress->zip
            ];
        }

//        $data = [
//            'user' => $userArray,
//            'products' => $productsArray,
//            'shipping' => $shippingArray,
//            'billing' => $billingArray
//        ];

        $order=new Order();
        $order->scenario='rest-create';
        $order->user=$userArray;
        $order->products=$productsArray;
        $order->shipping=$shippingArray;
        $order->save();

        $orderData=['id'=>$order->id];
//        $orderData = \Yii::$app->eStore->post('order', $data);
//        $orderData = $orderData['data'];
//        if ($orderData['id']) {
//            $this->order_id = $orderData['id'];
//        }

        return $orderData;
    }
    
    public function setDiscount(Discounts $discount){
        $this->discount = $discount;
        $this->serializeCart();
    }
    
    public function getDiscount(){
        return $this->discount;
    }

}