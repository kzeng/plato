<?php
namespace backend\controllers;


use Yii;
use common\models\CollectionPlace;
use common\models\CollectionPlaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommonPagesController implements the CRUD actions for BarCode model.
 */
class CommonPagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        // return $this->render('index', [
        //     // 'searchModel' => $searchModel,
        //     // 'dataProvider' => $dataProvider,
        // ]);
        return "common pages index...";
    }

    public function actionComingsoon()
    {
        return $this->render('comingsoon', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }


}
