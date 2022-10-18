<?php

namespace app\modules\admin\models\forms;


use app\models\User;

class AdminSignupForm extends \yii\base\Model
{
    public string $username = '';
    public string $email = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $password = '';

    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @throws \yii\base\Exception
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->load([
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'type' => User::TYPE_ADMIN,
            'status' => User::STATUS_ACTIVE,
        ], '');
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if (!$user->save()) {
            $this->addErrors($user->getErrors());
            return false;
        }
        return true;
    }

}