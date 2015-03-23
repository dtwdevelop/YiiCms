<?php

namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\Profile;
use app\modules\user\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\user\models\User;
use yii\web\ForbiddenHttpException;
/**
 * AccountController implements the CRUD actions for Profile model.
 */
class AccountController extends Controller
{
    public function behaviors()
    {
        return [
//             'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['login', 'logout',],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login'],
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['logout',],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
//    public function beforeAction($action)
//{
//    if (parent::beforeAction($action)) {
//        if (!\Yii::$app->user->can($action->id)) {
//            throw new ForbiddenHttpException('Access denied');
//        }
//        return true;
//    } else {
//        return false;
//    }
//}

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id=null)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();
        $user  = new User;
        
       // $model->link('users', $user);
       
        if ($user->load(Yii::$app->request->post()) && $user->save() && $model->load(Yii::$app->request->post()) && $model->save(false)) {
           
            return $this->redirect(['view', 'id' => $model->profile_id]);
        } else {
        
            if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
            return $this->render('create', [
                'model' => $model,
                'model2'=>$user,
                
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
         $user  =  $model->users;
        if ($model->load(Yii::$app->request->post()) && $model->save() && $user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['view', 'id' => $model->profile_id]);
        } else {
            if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
            return $this->render('update', [
                'model' => $model,
                 'model2' => $user,
                
            ]);
        }
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          if (!\Yii::$app->user->can('adminCan')) {
            throw new ForbiddenHttpException('Access denied');
        }
       $model = $this->findModel($id);
       $user_id = $model->user_id;
       $model ->delete();
        User::findOne(['id'=>$user_id])->delete();
       
        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
           
        }
    }
}
