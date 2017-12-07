<?php

namespace wbp\eStoreApi\cart\controllers;

use backend\modules\orders\models\OrderForm;
use backend\modules\products\models\Products;
use common\models\LoginForm;
use frontend\controllers\BaseController;
use frontend\models\RegisterForm;
use wbp\eStoreApi\PaymentMethod;
use wbp\eStoreApi\system\models\BillingAddressForm;
use wbp\eStoreApi\system\models\ShippingAddressForm;
use Yii;
use yii\data\ArrayDataProvider;


class ShoppingCartController extends BaseController
{
    public $viewsPath = '@wbp/eStoreApi/cart/views/';
    public $viewsSystemPath = '@wbp/eStoreApi/system/views/';

    public function actionIndex()
    {
//        Yii::$app->eStoreCart->clear();

        $products = new ArrayDataProvider([
            'allModels' => Yii::$app->eStoreCart->getProducts()
        ]);
//        $billingAddress = new BillingAddressForm();
//        $shippingAddress = new ShippingAddressForm();

//        if (Yii::$app->eStoreCart->billingAddress)
//            $billingAddress->load(Yii::$app->eStoreCart->billingAddress->getAttributes(), '');
//        elseif (Yii::$app->user->id)
//            $billingAddress->load(Yii::$app->user->identity->billingAddress->getAttributes(), '');
//
//        if (Yii::$app->eStoreCart->shippingAddress)
//            $shippingAddress->load(Yii::$app->eStoreCart->shippingAddress->getAttributes(), '');
//        elseif (Yii::$app->user->id)
//            $shippingAddress->load(Yii::$app->user->identity->shippingAddress->getAttributes(), '');

//        $paymentMethods = PaymentMethod::all();

//        $loginForm = new LoginForm();
//        $loginForm->return = Url::to(['cart/index']);

//        $orderForm = new OrderForm(['scenario' => OrderForm::FRONTEND_CHECKOUT_SCENARIO]);

        if (!$products->getCount()) return $this->render($this->viewsPath . 'empty');
        return $this->render($this->viewsPath . 'index', [
            'products' => $products,
//            'loginForm' => $loginForm,
//            'billingAddress' => $billingAddress,
//            'shippingAddress' => $shippingAddress,
//            'orderForm' => $orderForm,
//            'paymentMethods' => $paymentMethods
        ]);
    }

    public function actionStep1(){
        if(Yii::$app->user->id) $this->redirect(['step-2']);

        $loginModel = new LoginForm();
        $registerModel = new RegisterForm();
        $registerModel->scenario='register';

        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            return $this->redirect(['index']);
        }

        if ($registerModel->load(Yii::$app->request->post()) && $registerModel->register()) {
            return $this->redirect(['index']);
        }

        $loginForm=$this->renderPartial($this->viewsSystemPath.'loginForm',['loginFormModel' => $loginModel]);

        $registerForm=$this->renderPartial($this->viewsSystemPath.'registerForm',['model' => $registerModel]);

        return $this->render($this->viewsPath.'step-1',['loginForm'=>$loginForm,'registerForm'=>$registerForm]);
    }

    public function actionStep2()
    {
        $validation = true;
        $post = Yii::$app->request->post();

        $shippingAddressForm = new ShippingAddressForm();
        $billingAddressForm = new BillingAddressForm();

        $paymentMethod = Yii::$app->request->post('payment_method');
        $paymentMethod = PaymentMethod::getById($paymentMethod);
        $paymentData = [];
        if ($paymentMethod->fields) {
            $paymentForm = $paymentMethod->getPaymentFormModel();
            if (!$paymentForm->load($post) || !$paymentForm->validate()) $validation = false;
            $paymentData = $paymentForm->getAttributes();
        }

        if ($shippingAddressForm->load($post)) {
            if ($shippingAddressForm->sameAsBilling) {
                $shippingAddressForm->load($post['BillingAddressForm'], '');
            }
            if ($shippingAddressForm->validate()) {
                Yii::$app->eStoreCart->setShippingAddress($shippingAddressForm->getAddress());
            }
        } else {
            $validation = false;
        }

        if ($billingAddressForm->load($post) && $billingAddressForm->validate()) {
            Yii::$app->eStoreCart->setBillingAddress($billingAddressForm->getAddress());
        } else {
            $validation = false;
        }

        if ($validation) {
            $order = $this->makeOrder();
            return $this->pay($order, $paymentMethod, $paymentData);
        }

        return $this->actionIndex();
    }

    public function makeOrder()
    {
        $order = Yii::$app->eStoreCart->order();
        return $order;
    }

    public function pay($order, $method, $data)
    {
        $data['order_id'] = $order['id'];
        $data['payment_method'] = $method->id;
        $paymentResult = Yii::$app->eStore->post('payment/do', $data);
        $paymentResult = $paymentResult['data'];

        Yii::$app->session->set('lastOrderId', $order['id']);
        if ($paymentResult['status'] == 'form') {
            Yii::$app->eStoreCart->clear();
            return $this->paymentFormResult($paymentResult['data']);
        } elseif ($paymentResult['status'] == 'error') {
            Yii::$app->session->setFlash('error', $paymentResult['data']['message']);
            return $this->redirect('error');
        } else {
            Yii::$app->eStoreCart->clear();
//            Yii::$app->session->setFlash('success',$paymentResult['data']['message']);
            return $this->redirect('success');
        }
    }

    public function paymentFormResult($data)
    {
        return $this->render($this->viewsPath . 'paymentForm', ['data' => $data]);
    }

    public function actionConfirmation()
    {
        $this->layout = '/empty';
        return $this->render($this->viewsPath . 'confirmation');
    }


    public function actionSuccess()
    {
        if ($order_id = Yii::$app->session->get('lastOrderId')) {
            Yii::$app->session->set('lastOrderId', 0);
        }
        if (!$order_id) $this->redirect(['site/index']);
        return $this->render($this->viewsPath . 'success', ['order_id' => $order_id]);
    }

    public function actionError()
    {
        if ($order_id = Yii::$app->session->get('lastOrderId')) {
            Yii::$app->session->set('lastOrderId', 0);
        }
        if (!$order_id) $this->redirect(['site/index']);
        $error_message = Yii::$app->session->getFlash('error');
        return $this->render($this->viewsPath . 'error', ['error_message' => $error_message]);
    }

    public function actionAddToCart($id=false, $qty = 1)
    {
        if(!$id) $id=Yii::$app->request->post('id');
        $product = Products::findOne(['id'=>$id]);
        $checkStock = $this->checkQty($product, $qty);
        if ($checkStock === true) {
            Yii::$app->eStoreCart->addProduct($product, $qty);
            if (!Yii::$app->request->isAjax) $this->redirect(['index']);
            else {
                $script = $this->updatePricesScript();
                echo "
                <script>
                    $script
                </script>
            ";
            }
        }
    }

    protected function checkQty(Products $product, $qty)
    {
        if ($product->stock->count < $qty) {
            Yii::$app->session->setFlash('error', 'Unfortunately there are only ' . $product->stock->count . ' item(s) in stock. You asked ' . $qty . ' items');
            $this->redirect(['product/index', 'name' => $product->href]);
            return false;
        }
        return true;
    }

    public function actionUpdateCartProduct($id='', $qty = 1)
    {
        if(!$id){
            $id=Yii::$app->request->post('id');
            $qty=Yii::$app->request->post('qty');
        }
        if($id){
            $product = Products::findOne(['id'=>$id]);
            Yii::$app->eStoreCart->updateProduct($product, $qty);
            if (!Yii::$app->request->isAjax) $this->redirect(['index']);
            else {
                $script = $this->updatePricesScript();
                echo "
                    <script>
                        $script
                    </script>
                ";
            }
        }
    }

    public function actionRemoveFromCart($id)
    {
        $product = Products::findOne(['id'=>$id]);
        if($product){
            Yii::$app->eStoreCart->removeProduct($product);
            if (!Yii::$app->request->isAjax) $this->redirect(['index']);
            else {
                $script = $this->updatePricesScript();
                echo "
                    <script>
                        $script
                    </script>
                ";
            }
        }
    }

    public function updatePricesScript()
    {
        $products = Yii::$app->eStoreCart->getProducts();
        $script='';
        $bc=Yii::$app->eStoreCart->beforeCurrencySing;
        $ac=Yii::$app->eStoreCart->afterCurrencySing;
        foreach ($products as $num => $product) {
            $price = $product->price;
            $subTotal = $product->getSubTotalPrice();
            $script .= <<<SCRIPT
                \$('[data-item-num={$num}][data-price-type=item]').html('{$bc}{$price}{$ac}');
                \$('[data-item-num={$num}][data-price-type=position]').html('{$bc}{$subTotal}{$ac}');
SCRIPT;
        }
        $subTotal = Yii::$app->eStoreCart->getSubTotal();
        $total = Yii::$app->eStoreCart->getTotal();

        $script .= <<<SCRIPT
                \$('[data-price=total]').html('{$bc}{$total}{$ac}');
                \$('[data-price=subtotal]').html('{$bc}{$subTotal}{$ac}');
SCRIPT;
        return $script;
    }

    public function actionUpdatePrices()
    {
        $script = $this->updatePricesScript();
        echo "
            <script>
                $script
            </script>
        ";
        Yii::$app->end();
    }

    public function actionPrintCart()
    {
        var_dump(Yii::$app->eStoreCart);
    }

    public function actionClearCart()
    {
        Yii::$app->eStoreCart->clear();
    }
}
