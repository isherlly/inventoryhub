<?php
require 'vendor/autoload.php';
require 'console/config/bootstrap.php';
require 'common/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require 'common/config/main.php',
    require 'console/config/main.php'
);

$app = new yii\console\Application($config);

use common\models\User;

$user = new User();
$user->username = 'admin';
$user->email = 'admin@example.com';
$user->setPassword('admin123');
$user->generateAuthKey();
$user->status = 10; // Active

if ($user->save()) {
    echo "User 'admin' created successfully with password 'admin123'" . PHP_EOL;
} else {
    echo "Error creating user: " . PHP_EOL;
    print_r($user->getErrors());
}
?>
