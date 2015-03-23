<?php

namespace app\modules\media\controllers;

use Yii;
use app\modules\media\models\Files;
use app\modules\media\models\SearchFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\media\models\Medias;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * FileController implements the CRUD actions for Files model.
 */
class FileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchFile();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Files();
        $media = new \app\modules\media\models\Medias;

        if ($model->load(Yii::$app->request->post()) &&$model->validate()) {
           
            
           $model->file = UploadedFile::getInstance($model, 'file');
           $file =Yii::$app->getSecurity()->generateRandomString().$model->file->baseName;
           $model->file->saveAs(Yii::$app->params['bigFoto'] . $file . '.jpeg');
           $model->big_foto = $file .'.jpeg' ;
           $model->big_small = 'sm_'.$file .'.jpeg' ;
          Image::thumbnail(Yii::$app->params['bigFoto'] .$model->big_foto, 200, 200)->save(Yii::$app->params['smallFoto'].$model->big_small);
          $model->save();
            return $this->redirect(['view', 'id' => $model->file_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'media' =>$media,
            ]);
        }
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->file_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
     public function deleteFile($big,$small){
        if(file_exists(Yii::$app->params['bigFoto'].$big)){
            unlink(Yii::$app->params['bigFoto'].$big);
        }
        if(file_exists(Yii::$app->params['smallFoto'].$small)){
             unlink(Yii::$app->params['smallFoto'].$small);
        }
        else{
            throw new NotFoundHttpException('file not exits '.$big .'!');
        }
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model =  $this->findModel($id);
        if($model === null){
            throw new NotFoundHttpException('Invalid params');
        }
        $this->deleteFile($model->big_foto, $model->big_small);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
