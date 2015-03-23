<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiController
 *
 * @author hide
 */
namespace app\controllers;
use yii\rest\Controller;
//use yii\rest\ActiveController;
use app\models\api\Categories;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


class NewController extends Controller {
   public $modelClass = 'app\models\api\Categories';
    public $serializer = [
         'class' => 'yii\rest\Serializer',
         'collectionEnvelope' => 'news',
     ];
    
    
   



   public function init()
{
    parent::init();
    \Yii::$app->user->enableSession = false;
}



public function actions()
{
    $actions = parent::actions();

    // disable the "delete" and "create" actions
    unset($actions['delete'], $actions['create']);

    // customize the data provider preparation with the "prepareDataProvider()" method
   // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    return $actions;
}


public function behaviors()
{
    $behaviors = parent::behaviors();
//    $behaviors['authenticator'] = ['class' => HttpBasicAuth::className(),];
    $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
    return $behaviors;
}

 public function actionIndex()
{
     
     
     return new ActiveDataProvider([
            'query' => Categories::find(),
        ]);
     
     
}

   public function actionView($id)
{
       if(!$id) throw new NotFoundHttpException();
    $data = Categories::findOne($id);
     return   ['news'=>$data];
}



}
