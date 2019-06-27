<?php
namespace api\modules\v1\controllers;

// use yii\rest\Controller;
use api\controllers\UserController as Controller;

class UserController extends Controller
{
    public function actions() {
        $action = parent::actions();

        unset($action['index']); // 删除父级方法
        // unset($action['create']);
        // unset($action['update']);
        // unset($action['delete']);

        return $action;
    }

    public function actionIndex()
    {
        return 'this is v1/user';
    }
}
