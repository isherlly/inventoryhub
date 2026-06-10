<?php
require 'vendor/autoload.php';
$config = require 'console/config/main.php';
$app = new yii\console\Application($config);

$users = \common\models\User::find()->all();
echo "Total users: " . count($users) . PHP_EOL;
foreach($users as $user) {
    echo "Username: " . $user->username . ", Status: " . $user->status . PHP_EOL;
}
?>
