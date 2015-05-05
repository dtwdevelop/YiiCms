<?php

namespace app\modules\media\controllers;

use Yii;
use app\modules\media\models\Medias;
use app\modules\media\models\Files;
use app\modules\media\models\SearchMedias;
use app\modules\media\models\Rating;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Sort;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;
/**
 * MediaController implements the CRUD actions for Medias model.
 */
class MediaController extends Controller
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
     * Lists all Medias models.
     * @return mixed
     */
    public function actionIndex()
    {
         if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        $searchModel = new SearchMedias();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medias model.
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
     * category list
     * @return type
     */
    public function actionList(){
         $sort = new Sort([
        'attributes' => [
           
            'title' => [
                'asc' => ['title' => SORT_ASC, ],
                'desc' => ['title' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'by Name',
            ],
            'created' => [
                'asc' => ['created' => SORT_ASC, ],
                'desc' => ['created' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'by Date',
            ],
        ],
    ]);
      $query = new Query();
    $provider = new ActiveDataProvider([
    'query' => $query->from('in_medias')->where(['show'=>1])->orderBy($sort->orders),
    'sort' => [
        // Set the default sort by name ASC and created_at DESC.
        'attributes' => [
           
            'created' => SORT_DESC
        ]
    ],
    'pagination' => [
        'pageSize' => 3,
       
    ],
]);
   
     $model = $provider->getModels();
     $pages = $provider->getPagination();
     
     
       return  $this->render('pages',['pages'=>$pages,'model'=>$model,'sorter'=>$sort]);
    }
    /**
     * Foto from category
     */
    public function actionRating(){
       $r = Yii::$app->request;
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      
       if($r->isAjax){
          
           $rating  = new Rating();
            if($rating->findOne(['user_id'=>Yii::$app->user->id,'foto_id'=>$r->get('gallery')]) === null){
           $rating->foto_id=$r->get('gallery');
           $rating->rating=$r->get('star');
           $rating->user_id  = Yii::$app->user->id;
           $rating->ip = $r->userIP;
           $rating->save();
    return [
        'message' => 'rate',
        'code' => 200,
        'info'=> Yii::$app->user->id
    ];
            }
            else{
                return [
        'message' => 'You vote before',
        'code' => 200,
    ];
                
            }
         
       }
       return [
        'message' => 'Invalid param',
        'code' => 200,
    ];
    }
    public  function actionPage(){
      $id =  Yii::$app->request->get('category');
      if(!Files::findAll(['media_id'=>$id])){
          throw new   NotFoundHttpException('Category Empty');
      }
       $rating  = new Rating();
       
          $sort = new Sort([
        'attributes' => [
          
            'created' => [
                'asc' => ['created' => SORT_ASC, ],
                'desc' => ['created' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'by Date',
            ],
        ],
    ]);
      $query = new Query();
    $provider = new ActiveDataProvider([
    'query' => $query->from('in_files')->where(['media_id'=>$id])->orderBy($sort->orders),
    'sort' => [
        
        'attributes' => [
           
            'created' => SORT_DESC
        ]
    ],
    'pagination' => [
        'pageSize' => 3,
       
    ],
]);
    $model = $provider->getModels();
     $pages = $provider->getPagination();
      $request = Yii::$app->request;
       if($request->isAjax){
            
           return  $this->renderPartial('fotos',['pages'=>$pages,'model'=>$model,'sorter'=>$sort,'rating'=>$rating]);
      }
     return  $this->render('fotos',['pages'=>$pages,'model'=>$model,'sorter'=>$sort,'rating'=>$rating]);
    }

    /**
     * Creates a new Medias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        $model = new Medias();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $model->file = UploadedFile::getInstance($model, 'file');
             $file = Yii::$app->getSecurity()->generateRandomString().$model->file->baseName;
             $model->file->saveAs('uploads/' . $file. '.' . $model->file->extension);
             $model->picture = $file .'.' . $model->file->extension;
             $model->save();
             return $this->redirect(['view', 'id' => $model->media_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Medias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $deletePic  = $model->picture;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
             $model->file = UploadedFile::getInstance($model, 'file');
             if(!isset($model->file->baseName)){
                  $model->save();
             }
             else{
             $file = Yii::$app->getSecurity()->generateRandomString().$model->file->baseName;
             $model->file->saveAs('uploads/' . $file . '.' . $model->file->extension);
             $model->picture = $file .'.' . $model->file->extension;
             $model->save();
             $this->deleteFile($deletePic);
             }
            return $this->redirect(['view', 'id' => $model->media_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function deleteFile($file){
        if(file_exists("uploads/$file")){
            unlink("uploads/$file");
        }
        else{
           // throw new NotFoundHttpException('file not exits '.$file .'!');
        }
    }

    /**
     * Deletes an existing Medias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $model =  $this->findModel($id);
      $this->deleteFile($model->picture);
      $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Medias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
