<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'homeUrl' => '/admin',
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
            'enableCsrfValidation' => false
        ],
        'urlManager' => [
            'class'=>'wbp\urlManager\UrlManager',
            'ruleConfig'=>['class'=>'\wbp\urlManager\UrlRule'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                '/elfinder/<action:[\w\-]+>' => 'elfinder/<action>',        // FOR CKEDITOR UPLOADER
                'adverts/select-category' =>'adverts/default/select-category',
                'adverts/route-by-type' =>'adverts/default/route-by-type',
                'adverts/save-apartment' =>'adverts/default/save-apartment',
                '<module:[\w\-]+>' => '<module>/default/index',

                '<module:[\w\-]+>/<action:(edit|add|view)>' => '<module>/default/<action>',
                '<module:[\w\-]+>/<action:(get-shopping-cart|get-regions)>' => '<module>/default/<action>',     //for orders
                '<module:[\w\-]+>/<controller:[\w\-]+>' => '<module>/<controller>/index',
                '<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
                '<module:[\w\-]+>/<action>' => '<module>/default/<action>'

            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for backend
                'path'=>'/backend/web'  // correct path for the backend app.
            ]
        ],
        'session' => [
            'name' => '_backendSessionId', // unique for backend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on backend
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n'=>array(
            'translations' => array(
                '*'=>array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@backend/messages",
                    'sourceLanguage' => 'en_US',
                    'fileMap' => array(
                    )
                ),
            )
        ),
        'lang' => [
            'class' => 'wbp\lang\Lang',
            'languages' => [
                'en-US' => '',
            ],
            'languagesUrls' => [
                'en-US' => '',
            ],
        ],
        'currentStore' => [
            'class' => '\backend\components\CurrentStore'
        ]
    ],
    'params' => $params,

    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',

    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl'=>'',
                    'basePath'=>'@serverDocumentRoot',
                    'path' => 'uploads',
                    'name' => 'Uploads',
                ],
            ],
        ]
    ],
];
