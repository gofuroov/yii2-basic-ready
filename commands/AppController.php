<?php

namespace app\commands;

use app\modules\admin\models\forms\AdminSignupForm;
use yii\helpers\Console;
use yii\web\NotFoundHttpException;

class AppController extends \yii\console\Controller
{
    public function actionIndex(): void
    {
        Console::output("****************************************");
        Console::output("* Welcome Yii2 basic ready by gofuroov *");
        Console::output("****************************************\n\n");
    }

    /**
     * Application installing
     * @return void
     * @throws NotFoundHttpException
     */
    public function actionInit(): void
    {
        $exampleEnvFile = \Yii::getAlias('@app/.env.example');
        $envFile = \Yii::getAlias('@app/.env');
        if (!file_exists($exampleEnvFile)) {
            throw new NotFoundHttpException("Example env file is not found: <code>$exampleEnvFile</code>");
        }
        if (file_exists($envFile)) {
            $answer = $this->convertHumanAnswer2Bool(Console::input("\n.env file already exist. Do you want replace it? Y/n: "));
            if ($answer) {
                unlink($envFile);
            } else {
                Console::output("\nCopying skipped.\n");
                return;
            }
        }

        copy($exampleEnvFile, $envFile);
        Console::output("\nCopying done.\n");
    }

    /**
     * @param string $answer
     * @return bool
     */
    private function convertHumanAnswer2Bool(string $answer): bool
    {
        return in_array($answer, ['y', 'Y', 'yes']);
    }

    /**
     * @return void
     * @throws \yii\base\Exception
     */
    public function actionCreateAdmin(): void
    {
        $form = new AdminSignupForm();

        Console::output("******************************");
        Console::output("* Created by Olimjon Gofurov *");
        Console::output("******************************\n\n");

        do {
            Console::output($form->getFirstError("username"));
            $form->username = Console::input($form->getAttributeLabel('username') . ": ");
        } while (!$form->validate(['username']));
        do {
            Console::output($form->getFirstError("email"));
            $form->email = Console::input($form->getAttributeLabel('email') . ": ");
        } while (!$form->validate(['phone']));
        do {
            Console::output($form->getFirstError("first_name"));
            $form->first_name = Console::input($form->getAttributeLabel('first_name') . ": ");
        } while (!$form->validate(['first_name']));
        do {
            Console::output($form->getFirstError("last_name"));
            $form->last_name = Console::input($form->getAttributeLabel('last_name') . ": ");
        } while (!$form->validate(['last_name']));
        do {
            Console::output($form->getFirstError("password"));
            $form->password = Console::input($form->getAttributeLabel('password') . ": ");
        } while (!$form->validate(['password']));

        if ($form->validate() && $form->save()) {
            Console::output("\n\n");
            Console::output("*********************************");
            Console::output("* Saqlandi: {$form->first_name} {$form->last_name} *");
            Console::output("*********************************\n\n");
            exit();
        }

        foreach ($form->getErrorSummary(true) as $error) {
            Console::output($error);
        }
    }
}