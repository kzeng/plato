<?php
namespace api\controllers;

use yii\rest\ActiveController;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\RateLimiter;

use api\models\LoginForm;

class UserController extends ActiveController {
    public $modelClass = 'common\models\User';

    public function actions() {
        $action = parent::actions();

        // unset($action['index']);
        // unset($action['create']);
        // unset($action['update']);
        // unset($action['delete']);

        return $action;
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::className(),
            'enableRateLimitHeaders' => true,
        ];

        $currentAction = \Yii::$app->controller->action->id;
        $authActions = ['login']; // 登录方法不参与验证

        if ( !in_array($currentAction, $authActions) ) {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                    QueryParamAuth::className(),
                ],
            ];
        }

        return $behaviors;
        // return ArrayHelper::merge([
        //     [
        //         'class' => Cors::className(),
        //         'cors' => [
        //             'Origin' => ['*'],
        //             'Access-Control-Request-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'],
        //             'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        //         ],
        //     ],
        // ], $behaviors);
    }

    public function actionLogin() {
        $model = new LoginForm();

        if ( $model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login() ) {
            return [
                'access_token' => $model->login(),
            ];
        } else {
            return $model->getFirstErrors();
        }
    }
}
