<?php
$econfig = [
    'components' => [
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
//             uncomment this to use streams in safe_mode
//            'useStreamsFallback' => true,
            ],
//             'tokenStorage' => array(
//             'class' => '@app\eauth\DatabaseTokenStorage',
//             ),
            'services' => [
//                'google' => [
//                    'class' => 'nodge\eauth\services\GoogleOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ],
//                'google_oauth' => [
//                    // register your app here: https://code.google.com/apis/console/
//                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'Google (OAuth)',
//                ],
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\extended\FacebookOAuth2Service',
                    'clientId' => '1660690044210341',
                    'clientSecret' => 'd44af724b23797365b7a5617d63520db',
                ],
                'twitter' => [
                    // register your app here: https://dev.twitter.com/apps/new
                    'class' => 'nodge\eauth\services\extended\TwitterOAuth1Service',
                    'key' => 'sDUq2MCihIMin4mFo417dxFzo',
                    'secret' => 'Z3z5dvJT73GewMaSoz12ozS9rTL6YHTVNcw4Jr1KiyuKQu9yYn',
                ],
//                'yahoo' => [
//                    'class' => 'nodge\eauth\services\YahooOpenIDService',
//                ],
//                'linkedin' => [
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
//                    'key' => '...',
//                    'secret' => '...',
//                    'title' => 'LinkedIn (OAuth1)',
//                ],
//                'linkedin_oauth2' => [
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'LinkedIn (OAuth2)',
//                ],
//                'github' => [
//                    // register your app here: https://github.com/settings/applications
//                    'class' => 'nodge\eauth\services\GitHubOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'live' => [
//                    // register your app here: https://account.live.com/developers/applications/index
//                    'class' => 'nodge\eauth\services\LiveOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'steam' => [
//                    'class' => 'nodge\eauth\services\SteamOpenIDService',
//                ],
//                'yandex' => [
//                    'class' => 'nodge\eauth\services\YandexOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ],
//                'yandex_oauth' => [
//                    // register your app here: https://oauth.yandex.ru/client/my
//                    'class' => 'nodge\eauth\services\YandexOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'Yandex (OAuth)',
//                ],
//                'vkontakte' => [
//                    // register your app here: https://vk.com/editapp?act=create&site=1
//                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'mailru' => [
//                    // register your app here: http://api.mail.ru/sites/my/add
//                    'class' => 'nodge\eauth\services\MailruOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'odnoklassniki' => [
//                    // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
//                    // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
//                    'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'clientPublic' => '...',
//                    'title' => 'Odnoklas.',
//                ],
            ],
        ],

        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => array('nodge\eauth\*'),
                    'logVars' => array(),
                ],
            ],
        ],
    ],
];

return $econfig;