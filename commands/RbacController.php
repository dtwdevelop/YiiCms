<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RbacController
 *
 * @author hide
 */
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController  extends Controller{
    //put your code here
    public function actionInit(){
      $auth =  Yii::$app->authManager ;
      $rule = new \app\rbac\AuthorRule;
      $rule2 = new \app\rbac\UserGroupRule;
      
      $auth->add($rule);
      $auth->add($rule2);
      
      $createPost  = $auth->createPermission('create');
      $createPost->description ='create post';
      $auth->add($createPost);
      
      $updatePost = $auth->createPermission('update');
      $updatePost->description ='update post';
      $auth->add($updatePost);
      
      $deletePost = $auth->createPermission('delete');
      $deletePost->description ='delete';
      $auth->add($deletePost);
      
      $adminP = $auth->createPermission('adminCan');
      $adminP->description ='adminCan';
      $auth->add($adminP);
      
      $updateOwnPost = $auth->createPermission('updateOwn');
      $updateOwnPost->description = 'Update own post';
      $updateOwnPost->ruleName = $rule->name;
      $auth->add($updateOwnPost);
      $auth->addChild($updateOwnPost, $updatePost);
      
      
      
      $user = $auth->createRole('user');
      $user->ruleName = $rule2->name;
      $auth->add($user);
      $auth->addChild($user, $createPost);
      $auth->addChild($user, $updateOwnPost);
      
      $admin  = $auth->createRole('admin');
      $admin->ruleName = $rule2->name;
      $auth->add($admin);
      $auth->addChild($admin, $updatePost);
      $auth->addChild($admin, $deletePost);
      $auth->addChild($admin, $adminP);
      $auth->addChild($admin,$user);
//      $auth->assign($admin, 1);
//      $auth->assign($user,2);
    }
}
