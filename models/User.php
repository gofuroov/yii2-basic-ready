<?php

namespace app\models;

use app\gofuroov\traits\TypesTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $photo
 * @property int $type
 * @property int $status
 * @property string|null $verification_token
 * @property int $created_at
 * @property int $updated_at
 * @property-read null|string $authKey
 * @property int|null $updated_by
 */
class User extends DefaultActiveRecord implements IdentityInterface
{
    use TypesTrait;

    public const TYPE_ADMIN = 1;
    public const TYPE_USER = 2;

    public static function getTypeList(): array
    {
        return [
            static::TYPE_ADMIN => 'Admin',
            static::TYPE_USER => 'User'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => false
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_key', 'password_hash', 'type'], 'required'],
            [['type', 'status', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['username', 'email', 'first_name', 'last_name', 'password_hash', 'password_reset_token', 'photo', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne([
            'auth_key' => $token,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * @param string $password
     * @return void
     * @throws \yii\base\Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @return void
     * @throws \yii\base\Exception
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @return string
     */
    public function getPhotoUrl(): string
    {
        if (!$this->photo) {
            return '/custom/images/defaultAvatar.png';
        }
        return ''; //TODO implement
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
