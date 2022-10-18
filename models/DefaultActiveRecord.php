<?php

namespace app\models;

/**
 * Default Active Record for all models
 *
 * @property-read string $statusName
 */
abstract class DefaultActiveRecord extends \yii\db\ActiveRecord
{
    public const STATUS_DELETED = 1;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;

    /**
     * Get all statuses
     * @return string[]
     */
    public static function getStatusList(): array
    {
        return [
            static::STATUS_DELETED => "O'chirilgan",
            static::STATUS_INACTIVE => 'Nofaol',
            static::STATUS_ACTIVE => 'Faol',
        ];
    }

    /**
     * Get status as name
     * @return string
     */
    public function getStatusName(): string
    {
        if ($this->hasProperty('status')) {
            return static::getStatusList()[$this->status] ?? '-';
        }
        return '-';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'photo' => 'Photo',
            'type' => 'Type',
            'status' => 'Status',
            'verification_token' => 'Verification Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}