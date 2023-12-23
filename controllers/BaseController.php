<?php

namespace app\controllers;

use app\utils\Cors;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
    ];

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        // remove authentication filter
        unset($behaviors['authenticator']);
        // add CORS filter
        $behaviors['corsFilter'] = Cors::settings();
        // add authenticator
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBearerAuth::class,
            ],
        ];
        // content Negotiator
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    /**
     * @param $data
     * @param $error
     * @param int $code
     * @param string $message
     * @return array
     */
    public function myResponse($data = [], $error = [], int $code = 0, string $message = ''): array
    {
        return [
            'success' => empty($error),
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'error' => $error,
        ];
    }
}
