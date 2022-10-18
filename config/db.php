<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => $_ENV['DB_CHARSET'],
    // Schema cache options (for production environment)
    'enableSchemaCache' => (bool)$_ENV['DB_SCHEMA_CACHE'],
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
