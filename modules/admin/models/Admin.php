<?php

namespace app\modules\admin\models;

class Admin extends \app\models\User
{
    public static function find()
    {
        return parent::find()
            ->andWhere([
                'type' => self::TYPE_ADMIN
            ]);
    }
}