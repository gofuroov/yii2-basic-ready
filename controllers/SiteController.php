<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;

class SiteController extends BaseController
{
    public function behaviors(): array
    {
        $parent = parent::behaviors();
        unset($parent['authenticator']);
        return $parent;
    }

    public function actionIndex():array
    {
        return $this->myResponse([
            'author' => [
                'name' => 'Olimjon Gofurov',
                'telegram' => 't.me/gofuroov'
            ]
        ]);
    }
}
