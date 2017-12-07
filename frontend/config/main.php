<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/',
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'], //['assetsAutoCompress']
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc',
                        'language' => 'ru',
//                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        'assetsAutoCompress' =>
            [
                'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
                'cssFileBottom' => true,
                'jsFileCompile' => false,
                'htmlCompress' => true,
                'enabled' => true
            ],
        'i18n' => array(
            'translations' => array(
                'dict*' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@frontend/messages",
                    'sourceLanguage' => 'ru-RU',
                ),
                'map*' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@frontend/messages",
                    'sourceLanguage' => 'ru-RU',
                ),
                'map_eng*' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@frontend/messages",
                    'sourceLanguage' => 'ru-RU',
                ),
                'admin*' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@backend/messages",
                    'sourceLanguage' => 'ru-RU',
                ),

            )
        ),

        'assetManager' => [
            'bundles' => [
//  --------------------  DISABLE BOOTSTRAP CSS
                'yii\web\JqueryAsset' => [
                    'js' => ['jquery.min.js']
                ],
                'yii\web\YiiAsset' => [
                    'js' => ['yii.min.js']
                ],
                'yii\widgets\ActiveFormAsset' => [
                    'js' => ['yii.activeForm.min.js']
                ],
                'yii\validators\ValidationAsset' => [
                    'js' => ['yii.validation.min.js']
                ],
                'yii\widgets\MaskedInputAsset' => [
                    'js' => ['min/jquery.inputmask.bundle.min.js']
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => ['css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => ['js/bootstrap.min.js']
                ],

//  -------------------------------------------------

            ],
        ],
        'request' => [
            'baseUrl' => '',
            'enableCsrfValidation' => false,
            'class' => 'wbp\lang\LangRequest'
        ],
        'user' => [
            'identityClass' => 'frontend\models\LocalUser',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
                'path' => '/frontend/web'  // correct path for the frontend app.
            ]
        ],
        'session' => [
            'name' => '_frontendSessionId', // unique for frontend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on frontend
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
        'urlManager' => [
            'class' => 'wbp\urlManager\UrlManager',
            'ruleConfig' => ['class' => '\wbp\urlManager\UrlRule'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'suffix' => '/',
            'rules' => [
                'sitemap.xml' => 'site/sitemap-xml',

                '' => 'site/index',
                'main'      => 'site/index',
                'about'     => 'site/about',
                'contacts'  => 'site/contact',
                'partners'  => 'site/partners',
                'catalog'   => 'catalog/index',
                'catalog/get-object-types'   => 'catalog/get-object-types',

                'property-managment'  => 'management/index',
                'property-managment/<href:[\w\-]+>'  => 'management/index',

                'request-for-rent'  => 'site/request-for-rent',
                'request-for-sale'  => 'site/request-for-sale',
                'can-not-find'  => 'site/can-not-find',

//                'catalog/<href:[\w\-]+>' => 'catalog/index',
                'catalog/<category:[\w\-]+>/<object:[\w\-]+>' => 'catalog/index',
                'catalog/<category:[\w\-]+>' => 'catalog/index',

                'news' => 'news/index',
                'news/<href:[\w\-]+>' => 'news/view',

                'services'      => 'services/index',
                'services/<href:[\w\-]+>' => 'services/view',

                'adverts'      => 'adverts/index',
//                'adverts/view' => 'adverts/view',
                'adverts/<href:[\w\-]+>' => 'adverts/view',

//                'blog'      => 'blog/index',
//                'blog/<href:[\w\-]+>' => 'blog/view',

                '<href:[\w\-]+>' => array(
                    'pattern' => '<href:[\w\-]+>',
                    'route' => 'site/generic-page',
                    'type' => 'db',
                    'fields' => array(
                        'href' => array('table' => 'pages', 'field' => 'href', 'parent_parameter' => 'parent_page'),
                    ),
                ),

                '<action:[\w\-]+>' => 'site/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
            ],
        ],
        'lang' => [
            'class' => 'wbp\lang\Lang',
            'languages' => [
                'ru-RU' => 'rus',
                'en-US' => '',
            ],
            'languagesUrls' => [
                'ru-RU' => '',
                'en-US' => 'en',
            ],
        ],
        'formatter' => [
            'locale'=>'ru_RU'
        ],

    ],
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'params' => $params,
    'aliases' => [
        '@wbp' => '@vendor/wbp',
        '@serverDocumentRoot' => $_SERVER['DOCUMENT_ROOT'],
        '@frontend' => '@serverDocumentRoot' . '/frontend',
    ],
];

if (file_exists(__DIR__ . '/eauth.php')) {
    $eauthConfig = require 'eauth.php';
    $config = \yii\helpers\ArrayHelper::merge($config, $eauthConfig);
    $eauthServices = array_keys($config['components']['eauth']['services']);
}

return $config;
