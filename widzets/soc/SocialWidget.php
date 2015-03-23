<?php
namespace app\widzets\soc;
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


class SocialWidget extends Widget
{
    
    public $title='';
   
   

    public function init()
    {
     
        
    }

    public function run()
    {
      return  $this->render('widget',["title"=>$this->title]);
         
    }
}
