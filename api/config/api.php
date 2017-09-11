<?php

$db = require(__DIR__ . '/../../config/db.php');
$fcm = require(__DIR__ . '/../../config/fcm.php');
$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic-api',
	'name' => 'SPA API',
	// Need to get one level up:
	'basePath' => dirname(__DIR__) . '/..',
    'timeZone' => 'Africa/Nairobi',
	'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '../vendor/bower-asset',
    ],
	'modules' => [
		'v1' => [
			'class' => 'app\api\modules\v1\module',
		],
        'gridview' => [
            'class' => 'kartik\grid\Module'
        ]
	],
    /*'assetManager' => [
        'basePath' => '@webroot/assets',
    ],*/
	'components' => [
        'fcm' => $fcm,
        'pdf' => [
            'class' => \kartik\mpdf\Pdf::classname(),
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
		'response' => [
			'class' => 'yii\web\Response',
			'on beforeSend' => function ($event) {
				$response = $event->sender;
				if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
					$response->data = [
						'success' => $response->isSuccessful,
						'data' => $response->data,
					];
					$response->statusCode = 200;
				}
			},
		],
		'request' => [
			'cookieValidationKey' => 'Qq0fIK5vB6mseTKoYXX-dVdwHQFYrEXC',
			'parsers' => [
				//'application/json' => 'yii\web\JsonParser',
			]
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
					// Create API log in the standard log dir
					// But in file 'api.log':
					'logFile' => '@app/runtime/logs/api.log',
				],
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => true,
			'showScriptName' => false,
			'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => [
						'v1/salon',
						'v1/salonworker',
						'v1/service', //
						'v1/offeredservice', //offered services
						'v1/reservation',
						'v1/reserved',
						'v1/reservedservice',
						'v1/payment',
						'v1/user',
						'v1/account',
						'v1/status',
						'v1/report',
						'v1/notification',
					],
					//'GET,HEAD <id:\d+>/booth' => 'booth/all-booths',
					'tokens' => [
						'{id}' => '<id:\\w+>',
						'{user_id}' => '<user_id:\\w+>',
					],
					'extraPatterns' => [
						'GET,POST all' => 'all',
						'GET,POST,PUT,DELETE push' => 'push',
						'GET,POST,PUT,DELETE token' => 'token',
						'POST login' => 'login',
						'POST register' => 'register',
						'POST add' => 'add',
						'POST reserve' => 'reserve',
						'POST confirm' => 'confirm',
						'POST cancel' => 'cancel',
						'POST assign-staff' => 'assign-staff',
						'POST {id}/add-service' => 'add-service',
						'POST add-service' => 'remove-service',
						'POST {id}/pay' => 'pay',
						'PUT {id}/update' => 'update',
						'GET {id}/salons' => 'salons',
						'GET {id}/salon-services' => 'salon-services',
						'GET {id}/all-services' => 'all-services',
						'GET {id}/service-list' => 'service-list',
						'GET {id}/staff' => 'staff',
						'GET account-type' => 'account-type',

                        'POST generate' => 'generate',

						'GET {id}/my-salons' => 'my-salons',
						'GET {id}/my-services' => 'my-services',
						'GET {id}/my-reservations' => 'my-reservations',
						'GET {id}/reserved-services' => 'reserved-services',
						'GET {id}/pending' => 'pending',
						'GET {id}/confirmed' => 'confirmed',
						'GET {id}/cancelled' => 'cancelled',
						'GET {id}/confirmed-reservations' => 'confirmed-reservations',
						'GET {id}/my-payments' => 'my-payments',
						'GET {id}/reservation-payments' => 'reservation-payments',
						'GET {id}/receipts' => 'receipts',
						'GET {user_id}/list' => 'list',
						//'GET all/{id}' => 'all',
						//'GET summary/{id}' => 'summary',
						//post actions
						//'POST document' => 'document',
						//'POST logo' => 'logo',
					],
				],
			],
		],
		'db' => $db,
		'user' => [
			'identityClass' => 'app\models\UserOld',
			'enableAutoLogin' => false,
		],
	],
	'params' => $params,
];

return $config;