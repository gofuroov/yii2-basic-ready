<?php
#Load ENV variables
(Dotenv\Dotenv::createImmutable(dirname(__DIR__)))->safeLoad();

# Set @uploads alias
Yii::setAlias('@uploads', dirname(__DIR__) . '/web/uploads');