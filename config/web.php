<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => 'vendor/bower-asset',
    ],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module'
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IAyw-vu_u-ruH_LfDNEFS-LEQR88cAdM',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\model_extended\USERS_MODEL',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //custom rules
                '/' => 'site/index',
                'my-salons' => 'salon/index',
                'my-staff' => 'staff/index',
                'my-payments' => 'payment/index',
				'pending-payments' => 'payment/pending-payments',
				'confirm-payment' => 'payment/confirm-payment',
				'finalized-payments' => 'payment/finalized-payments',
                'my-bookings' => 'reservation/index',
                'add-service' => 'salonservices/create',
                'assign-service' => 'booked/assign-service',
                'confirm-service' => 'booked/confirm-service',
                'confirm-reservation' => 'reservation/confirm-reservation',
                'process-reservation' => 'reservation/process-reservation',
                'confirm' => 'reservation/confirm',
                'services' => 'service/index',

                'active-users' => 'user/active-users',
                'pending-users' => 'user/pending-users',
                'inactive-users' => 'user/inactive-users',
                'user-status' => 'user/user-status',
            ],
        ],
        //formatting class
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            //'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            //'timeZone' => 'GMT', //default time zones and format
            'currencyCode' => 'KES',
            'nullDisplay' => '0'
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
