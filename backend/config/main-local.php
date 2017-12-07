<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CKd6jzFG600f_qDj5xbcVx5ZqKVViK4p',
        ],
    ],

];


if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] =  [
//        'class' => 'yii\debug\Module',
//        'allowedIPs' => ['192.168.1.*'],
//    ];

//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = 'yii\gii\Module';
//    'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*', 'XXX.XXX.XXX.XXX']
}

return $config;
