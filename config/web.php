<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Reset Password Buku Pengunjung',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 'bootstrap' => ['log', 'oauth2'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'p96UvA2GvN6I67snOOexp1SLJEUJmqch',
            'parsers' => [
              'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession'   => false,
            'loginUrl'        => null
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'  => [
          'class' => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@app/mail',
            'useFileTransport' => false,
            'transport'        => [
              'class'      => 'Swift_SmtpTransport',
              'host'       => 'smtp.gmail.com',
              'username'   => 'arsgaming159@gmail.com',
              'password'   => 'Andririzki12345',
              'port'       => '465',
              'encryption' => 'ssl',
            ],
        ],
        // 'mailer' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     // send all mails to a file by default. You have to set
        //     // 'useFileTransport' to false and configure a transport
        //     // for the mailer to send real emails.
        //     // 'port' => '587', // Port 25 is a very common port too
        //     'useFileTransport' => true,
        //     'transport' => [
        //       'class' => 'Swift_SmtpTransport',
        //       'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
        //       'username' => 'andri.rizki007@gmail.com',
        //       'password' => 'Andririzki12345',
        //       'port' => '465', // Port 25 is a very common port too
        //       'encryption' => 'ssl', // It is often used, check your provider or mail server specs
        //       // 'plugins' => [
        //       //     [
        //       //         'class' => 'Swift_Plugins_ThrottlerPlugin',
        //       //         'constructArgs' => [20],
        //       //     ],
        //       // ],
        //     ],
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [
                // 'POST oauth2<action:\w+>' => 'api/user/login<action>',
                // 'oauth2' => 'oauth2/login',
                // [
                //   'class'      => 'yii\rest\UrlRule',
                //   'pluralize'  => false,
                //   'controller' => [
                //     'authorize' => 'site/login'
                //   ]
                // ],
                [
                  'class'      => 'yii\rest\UrlRule',
                  'pluralize'  => false,
                  'controller' => [
                    'api/v1/anggota'   => 'api/anggota',
                    'api/v1/kehadiran' => 'api/kehadiran'
                  ]
                ]
            ],
        ],
    ],
    'modules' => [
      'api'   => [
        'class' => '\app\modules\api\Module'
      ],
      // 'oauth2' => [
      //   'class' => 'filsh\yii2\oauth2server\Module',
      //   'tokenParamName' => 'accessToken',
      //   'tokenAccessLifetime' => 3600 * 24,
      //   'storageMap' => [
      //       'user_credentials' => 'app\models\User',
      //   ],
      //   'grantTypes' => [
      //       'user_credentials' => [
      //           'class' => 'OAuth2\GrantType\UserCredentials',
      //       ],
      //       'refresh_token' => [
      //           'class' => 'OAuth2\GrantType\RefreshToken',
      //           'always_issue_new_refresh_token' => true
      //       ]
      //   ]
      // ]
    ],
    'params' => $params,
    'timeZone' => 'Asia/Jakarta',
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
