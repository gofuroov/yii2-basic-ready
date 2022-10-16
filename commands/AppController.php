<?php

namespace app\commands;

use yii\helpers\Console;
use yii\web\NotFoundHttpException;

class AppController extends \yii\console\Controller
{
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
}