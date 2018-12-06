<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'timeZone'=>'Asia/Calcutta',
	'name' => 'Swayambhar',
    'components' => [
		'assetManager' => [
			'bundles' => [
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js'=>[]
				],
			],
		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'swayambhar@2018!23$',
			'baseUrl' => '/swayambhar',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => stristr($_SERVER['REQUEST_URI'], "/admin") ? 'app\modules\admin\models\Admin' : 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.swayambhar.in',
                'username' => 'info@swayambhar.in',
                'password' => '@z,xFA=-hS2g',
                'port' => '465',
                'encryption' => 'ssl',
            ],
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
            'baseUrl' => '/swayambhar',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'login'=> 'site/login',
				'logout'=> 'site/logout',
				'register'=> 'site/register',
				'admin/logout'=> 'admin/default/logout',
			],
        ],
        
    ],
    'params' => $params,
	'layout' => (stristr($_SERVER['REQUEST_URI'], "/admin")) ? '@app/web/themes/backend/adminlte/templates/Default/Page':'@app/web/themes/frontend/default/templates/Default/Page',
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
