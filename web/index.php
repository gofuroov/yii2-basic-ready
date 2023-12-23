<?php
require __DIR__ . '/../vendor/autoload.php';

// load ENV variables
(Dotenv\Dotenv::createImmutable(dirname(__DIR__)))->safeLoad();

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', (bool)$_ENV['APP_DEBUG']);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// bootstrap file
require __DIR__ . '/../config/bootstrap.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
