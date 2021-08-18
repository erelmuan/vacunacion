<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Inicio',
    'language' => 'es_es',
    'timeZone'  => 'America/Buenos_Aires',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
      'assetManager' => [
              'bundles' => [
                  'rce\material\Assets' => [
      	              'siteTitle' => 'Vacunacion',
                      'sidebarColor' => 'azure',
                      'sidebarBackgroundColor' => 'blue',
                      'sidebarBackgroundImage' => 'img url'
                  ],
              ],
          ],



      'view' => [
        'theme' => [

          'pathMap' => ['@app/views' => '@vendor/ricar2ce/yii2-material-theme/view'],
        ]
    ],

'request' => [

        	// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation

        	'cookieValidationKey' => 'sadasdasdasrgynjhynsefs',

        	'enableCsrfValidation' => false,

],
        // 'request' => [
        //     // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        //     'cookieValidationKey' => 'sadasdasdasrgynjhynsefs',
        // ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            //agregado el 8 de julio
            'class' => 'app\components\User', // extend User component
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    //restringir el acceso y volver al login si no esta registrado
 'as beforeRequest' => [
     'class' => 'yii\filters\AccessControl',
     'rules' => [
         [
             'allow' => true,
             'actions' => ['login'],
         ],
         [
             'allow' => true,
             'roles' => ['@'],
         ],
         [
             'allow' => false,
             'actions' => ['login'],
             'roles' => ['@'],
         ],
     ],
     'denyCallback' => function () {
         return Yii::$app->response->redirect(['site/login']);
     },
 ],
 'modules' => [
     'gridview' => ['class' => 'kartik\grid\Module'],
     'datecontrol' =>  [
        'class' => '\kartik\datecontrol\Module'
    ]
 ] ,
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
