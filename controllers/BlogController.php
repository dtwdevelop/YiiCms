<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\EntryForm;
use app\models\News ;
use app\models\Users ;
class BlogController extends Controller {
    
    public function actionIndex(){
        
        
        
        return $this->render('index', ['say'=>'Yii 2 come !']);
    }
    
    public function actionMail(){
        $model = new EntryForm;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->render('entry-confirm', ['model' => $model]);
        }
        else{
            return $this->render('entry', ['model' => $model]);
        }
    }
    public function actionNews(){
        \Yii::$app->language = 'ru-RU';
        $article  =  News::find();
        $pages = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $article->count(),
        ]);
        
        $query = $article->orderBy('new_id')->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('news',['data'=>$query,'pages'=>$pages]);
    }
}