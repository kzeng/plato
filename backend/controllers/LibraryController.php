<?php

namespace backend\controllers;

use Yii;

use common\models\Library;
use common\models\LibrarySearch;

use common\models\U;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use  yii\web\UploadedFile;


/**
 * LibraryController implements the CRUD actions for Library model.
 */
class LibraryController extends Controller
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

    /**
     * Lists all Library models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LibrarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Library model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Library model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Library();

        if ($model->load(Yii::$app->request->post()) ) {

            //单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";
                $targetFile = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . 'web/uploads' . DIRECTORY_SEPARATOR . $targetFileName;
                U::kzeng_W($targetFile);
                $model->file->saveAs($targetFile);

                $model->logo_img = "/uploads/{$targetFileName}";
                U::kzeng_W($model->logo_img);
            }

            $model->user_id = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Library model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            U::kzeng_W("----------------------upload img------------------------");
            //单文件上传
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $targetFileId = date("YmdHis").'-'.uniqid();
                $ext = pathinfo($model->file->name, PATHINFO_EXTENSION);
                $targetFileName = "{$targetFileId}.{$ext}";
                $targetFile = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . 'web/uploads' . DIRECTORY_SEPARATOR . $targetFileName;
                U::kzeng_W($targetFile);
                $model->file->saveAs($targetFile);

                $model->logo_img = "/uploads/{$targetFileName}";
                U::kzeng_W($model->logo_img);
            }

            $model->user_id = Yii::$app->user->id;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Library model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Library model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Library the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Library::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
