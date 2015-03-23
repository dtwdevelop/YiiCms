<?php
//define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
//define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
//define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
//define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
//define('DB_NAME', getenv('OPENSHIFT_APP_NAME'));
$inside =false;
if($inside == true){
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=centerpc_inside',
    'username' => 'centerpc_inside',
    'password' => 'panzer777',
    'charset' => 'utf8',
];
}
else{
    return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yiiblog',
    'username' => 'root',
    'password' => 'demo',
    'charset' => 'utf8',
];
}
