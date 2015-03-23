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
//use yii\rest\Controller;
use yii\rest\ActiveController;
use app\models\api\User;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;


class ApiController extends ActiveController {
   public $modelClass = 'app\models\api\User';
   
 public function actionIndex()
{
    return User::find()->all();
    
}

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

   public function actionView($id)
{
    return User::findOne($id);
}

public function actionCreate(){
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return [
        'message' => 'created',
        'code' => 200,
    ];
    
}

 public function actionUpdate($id){
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return [
        'message' => 'update',
        'code' => 200,
    ];
 }

 public function actionOptions(){
     
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return [
        'message' => 'api beta',
        'code' => 200,
    ];
 }
 

}
