<?php
/**
 * Created by PhpStorm.
 ** User: Леха alexeymarkov.x7@gmail.com
 *** Date: 04.02.2016
 **** Time: 14:23
 */

namespace wbp\eStoreApi;

use Yii;
use yii\base\Model;

class Order extends Model
{

    public static function create()
    {
        $data = [
            'user' => [
                'client_id' => 5,
                'first_name' => 'Test F',
                'last_name' => 'Test F',
                'email' => 'qwe@qwe.qeww',
                'phone' => '123456789',
            ],
            'products' => [
                [
                    'product_id' => 10,
                    'qty' => 1
                ]
            ],
            'shipping' => [
                'address' => 's_address',
                'address1' => 's_address1',
                'country_id' => 22,
                'state_id' => 506,
                'city' => 'Los Angeles',
                'zip' => '91000',
            ],
            'billing' => [
                'address' => 's_address',
                'address1' => 's_address1',
                'country_id' => 22,
                'state_id' => 506,
                'city' => 'Los Angeles',
                'zip' => '91000',
            ],
            'comment' => 'olol'
        ];
        $response = Yii::$app->eStore->post('order', $data);
        var_dump($response);
        exit;
        $products = Yii::$app->eStoreCart->getProducts();

        return $response;

    }

    /**
     * http://estore.local.com/rest/v1/order
     *
     * user[client_id]=5
     * &user[first_name]=ASD
     * &products[0][product_id]=10
     * &products[0][qty]=2
     * &products[1][product_id]=9
     * &products[1][qty]=1
     * &shipping[address]=s_address
     * &shipping[address1]=s_address1
     * &shipping[country_id]=22
     * &shipping[state_id]=506
     * &shipping[city]=Los Angeles
     * &shipping[zip]=91000
     * &billing[address]=b_address
     * &billing[address1]=b_address1
     * &billing[country_id]=129
     * &billing[state_id]=2045
     * &billing[city]=Montreal
     * &billing[zip]=S4D 3E5
     * &comment=Test
     */

}