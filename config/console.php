<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
          'authManager' => [
            'class' => 'yii\rbac\PhpManager',
              'defaultRoles' => ['admin','user'], // here define your roles
            //'authFile' => '@console/data/rbac.php' //the default path for rbac.php | OLD CONFIGURATION
            'itemFile' => '@app/data/items.php', //Default path to items.php | NEW CONFIGURATIONS
            'assignmentFile' => '@app/data/assignments.php', //Default path to assignments.php | NEW CONFIGURATIONS
	     'ruleFile' => '@app/data/rules.php', 
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
