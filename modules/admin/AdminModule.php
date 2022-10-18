<?php

namespace app\modules\admin;

use app\modules\admin\models\Admin;
use yii\helpers\Url;

/**
 * admin module definition class
 */
class AdminModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public $layout = 'adminLte';

    /**
     * @var string
     */
    public $defaultRoute = 'default';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        \Yii::$app->user->identityClass = Admin::class;
        \Yii::$app->user->loginUrl = ['/admin/site/login'];

        parent::init();
    }
}
