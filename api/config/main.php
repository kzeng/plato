<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
           'class' => 'api\modules\v1\Module',
       ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/api',
        ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => true, // 自动登录
            'enableSession'=>false, // 关闭 session
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [ // url 处理
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true, // 严格解析模式
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    // 'pluralize' => false, // 复数
                    'extraPatterns' => [
                        'POST login' => 'login',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'library',
                    'extraPatterns' => [],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/default',
                    'extraPatterns'=>[
                        'GET index' => 'index',
                    ],
                ],
               [
                   'class' => 'yii\rest\UrlRule',
                   'controller' => 'v1/user',
                   'extraPatterns'=>[
                       'GET index'=>'index',
                   ],
               ],
            ],
        ],
        'response' => [ // 响应
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $response->data = [
                    'success' => $response->isSuccessful,
                    'code' => $response->getStatusCode(),
                    'message' => $response->statusText,
                    'data' => $response->data,
                ];
                $response->statusCode = 200;
            },
        ],
    ],
    'params' => $params,
];
