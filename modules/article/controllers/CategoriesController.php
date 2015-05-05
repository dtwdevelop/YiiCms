<?php

namespace app\modules\article\controllers;

use Yii;
use app\modules\article\models\Categories;
use app\modules\article\models\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    public $widzet=false; 
  
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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
          if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPages(){
     $parent =  Yii::$app->request->get('pages');
    
    $query = new Query();
    $provider = new ActiveDataProvider([
    'query' => $query->from('in_page')->where(['page_id'=>$parent,'show'=>1]),
    'sort' => [
        // Set the default sort by name ASC and created_at DESC.
        'attributes' => [
           
            'created' => SORT_DESC
        ]
    ],
    'pagination' => [
        'pageSize' => 1,
    ],
]);
     $model = $provider->getModels();
     $pages = $provider->getPagination();
       $this->widzet=true;
         Yii::$app->view->params['article'] = 'widzet';
        $request = Yii::$app->request;
        if($request->isAjax){
            
           return  $this->renderAjax('page',['pages'=>$pages,'model'=>$model,"widget"=>$this->widzet]);
      }
       return  $this->render('pages',['pages'=>$pages,'model'=>$model,"widget"=>$this->widzet]);
    }
    
    public  function actionList(){
        
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
      if($tag = Yii::$app->request->get('tag')){
          $tag =$tag;
        //  $query->filterWhere(['LIKE' ,'meta_tags',strtr($tag,['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']),'%', false]);
      }
      else{
           $tag="";
      }
      
    $provider = new ActiveDataProvider([
    'query' => $query->from('in_page')->Where(['show'=>1])->andWhere(['LIKE' ,'meta_tags','%'.strtr($tag,['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']).'%', false])->orderBy($sort->orders),
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
     Yii::$app->view->params['article'] = 'widzet';
     $model = $provider->getModels();
     $pages = $provider->getPagination();
     $request = Yii::$app->request;
        if($request->isAjax){
            
           return  $this->renderAjax('pages',['pages'=>$pages,'model'=>$model,"widget"=>$this->widzet]);
      }
       return  $this->render('pages',['pages'=>$pages,'model'=>$model,'sorter'=>$sort,"widget"=>$this->widzet]);
    }

    /**
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $model->update();
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
          if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
            //  print_r($model->oldTag);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
