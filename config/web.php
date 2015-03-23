<?php

$params = require(__DIR__ . '/params.php');
$local =false;
$config = [
    'id' => 'basic',
     'defaultRoute' => 'categories/list',
    'language' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TY72RPzxCKrwZuBLVd316YnKtj_e7Cx7',
             'parsers' => [
        'application/json' => 'yii\web\JsonParser',
    ],
            
],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'google' => $local? [
                'class' => 'yii\authclient\clients\GoogleOAuth',
                //local
                'clientId' => '840645611284-l6qhd14re2d6i71fvjmotq4vnfmjse2f.apps.googleusercontent.com',
                'clientSecret' => 'rcE6vK54xiewgmAZyolOTN9u',
                
            ]:
            [
                'class' => 'yii\authclient\clients\GoogleOAuth',
                //site
                 'clientId' => '840645611284-ujlt2drli68st45k3l7p9di36eaf77uq.apps.googleusercontent.com',
                'clientSecret' => '7ZGPMRK3kvGFYDL3TJp-55lX',
               
               
                
            ],
//            'facebook' => [
//                'class' => 'yii\authclient\clients\Facebook',
//                //site
//                'clientId' => '426631614168206',
//                'clientSecret' => '64c2a0ca496189444ad225f8c254d265',
//                
//                // local
//                'clientId' => '426639344167433',
//                'clientSecret' => 'f84480ff61e0f0c29901a38538081be2',
//                
//            ],
            
//            
//              'linkedin' => [
//                'class' => 'yii\authclient\clients\LinkedIn',
//                'clientId' => 'linkedin_client_id',
//                'clientSecret' => 'linkedin_client_secret',
//            ],
            
            // etc.
        ],
    ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            
        ],
//        'view' => [
//            'class' => 'yii\web\View',
//            'renderers' => [
//                'tpl' => [
//                    'class' => 'yii\smarty\ViewRenderer',
//                    //'cachePath' => '@runtime/Smarty/cache',
//                ],
//                'twig' => [
//                    'class' => 'yii\twig\ViewRenderer',
//                    'cachePath' => '@runtime/Twig/cache',
//                    // Array of twig options:
//                    'options' => [
//                        'auto_reload' => true,
//                    ],
//                    'globals' => ['html' => '\yii\helpers\Html'],
//                    'uses' => ['yii\bootstrap'],
//                ],
//                // ...
//            ],
//        ],
  
        'urlManager' => [
          
            
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'enableStrictParsing' => true,
//            'suffix' => '.html',
            'rules' => [
              'categories/<pages:\d+>' => 'categories/pages',
               'gallery/list' =>'media/media/list',
               'gallery/page' => 'media/media/page',
                 'gallery/rating' => 'media/media/rating',
                
            ['class' => 'yii\rest\UrlRule', 'controller' => 'api'],
             ['class' => 'yii\rest\UrlRule', 'controller' => 'new'],
   
         ],
           
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
             'defaultRoles' => ['admin','user'], // here define your roles
            //'authFile' => '@console/data/rbac.php' //the default path for rbac.php | OLD CONFIGURATION
            'itemFile' => '@app/data/items.php', //Default path to items.php | NEW CONFIGURATIONS
            'assignmentFile' => '@app/data/assignments.php', //Default path to assignments.php | NEW CONFIGURATIONS
	     'ruleFile' => '@app/data/rules.php', 
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
//            'transport' => [
//            'class' => 'Swift_SmtpTransport',
//            'host' => 'smtp.gmail.com',
//            'username' => 'username@gmail.com',
//            'password' => 'password',
//            'port' => '587',
//            'encryption' => 'tls',
//                        ],
        ],
        'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
//                'sourceLanguage' => 'en-US',
//                'fileMap' => [
//                    'app' => 'app.php',
////                    'app/error' => 'error.php',
//                ],
            ],
        ],
    ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
     'modules' => [
        'media' => [
            'class' => 'app\modules\media\Media',
        ],
          'user' => [
            'class' => 'app\modules\user\User',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
