<?php
namespace app\widzets\tags;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tags
 *
 * @author hide
 */
use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\Tags;

class TagcloudWidget extends Widget
{
    public $limit=10;
    public $title='';
    public $foto;
    public $class='default';
    public $tags;

    public function init()
    {
     $tag = new Tags;
     $this->tags =  $tag->findFrfrequency();
        
    }

    public function run()
    {
      return  $this->render('widzet',['tags'=>$this->tags,"title"=>$this->title]);
         
    }
}
