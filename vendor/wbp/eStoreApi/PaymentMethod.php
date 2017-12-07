<?php

namespace wbp\eStoreApi;

use yii\base\DynamicModel;
use yii\base\Model;
use yii\web\View;

class PaymentMethod extends Model
{
    const PAYPAL_PRO = 2;
    static public $models = [];

    public $id, $title, $name, $fields, $card_types;

    public function rules()
    {
        return [
            [[
                'id', 'title', 'name', 'fields', 'card_types'
            ], 'safe'],
        ];
    }

    static public function all($cache = true)
    {
        $data = \Yii::$app->eStore->get('payment', $cache);
        self::$models = self::getPayFromData($data);
        return self::$models;
    }

    static public function getById($id, $cache = true)
    {
        if (!isset(self::$models[$id])) self::$models = self::all($cache);

        return self::$models[$id];
    }


    public function getTitle()
    {
        if ($this->name == 'PayPalPro') return 'by credit card';
        return $this->title;
    }

    public static function getPayFromData($data)
    {
//        if ($data['id']) $data = array($data);
//        if ($data['data']) $data = array($data['data']);
        if ($data) {
            foreach ((array)$data as $payData) {
                $pay = new PaymentMethod();
                $pay->load($payData, '');
                $card_types = [];
                foreach ((array)$payData['card_types'] as $type) {
                    $card_types[$type['id']] = $type['title'];
                }
                $pay->card_types = $card_types;

                $result[$pay->id] = $pay;
            }

            return $result;
        } else {
            return false;
        }
    }

    public function getPaymentFormModel()
    {
//        $fields = $this->fields;
//        var_dump($fields);exit;
        $fields[] = 'card_number';
        $fields[] = 'card_name';
        $fields[] = 'card_type';
        $fields[] = 'card_month';
        $fields[] = 'card_year';
        $fields[] = 'card_cvv';

        $fields[] = 'paymentSelected';

        $model = new DynamicModel($fields);

        if (\Yii::$app->user->id) {
            $userCardData = \Yii::$app->user->identity->getUserCC();
            $cardData = [
                'card_number' => \Yii::$app->encrypter->decrypt($userCardData['number']),
                'card_name' => \Yii::$app->encrypter->decrypt($userCardData['cardholder_name']),
                'card_type' => $userCardData['type']['id'],
                'card_month' => (int)\Yii::$app->encrypter->decrypt($userCardData['expired_month']),
                'card_year' => \Yii::$app->encrypter->decrypt($userCardData['expired_year']),
                'card_cvv' => \Yii::$app->encrypter->decrypt($userCardData['cvv'])
            ];
            foreach ($cardData as $name => $value) {
                $model->{$name} = $value;
            }
        }

        $model->addRule($this->fields, 'required', ['when' => function ($model) {
            return $model->paymentSelected == 1;
        }, 'whenClient' => "function (attribute, value) {
            return $('#payForm_" . $this->id . " .selector').val() == '1';
        }"]);


        return $model;
    }

    public function getPaymentForm(View $view, $form)
    {
        if ($this->fields) $model = $this->getPaymentFormModel();

        return $view->render(\Yii::$app->controller->viewsPath . $this->name, ['form' => $form, 'method' => $this, 'model' => $model]);
    }

}