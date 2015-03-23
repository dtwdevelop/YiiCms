<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Last
 *
 * @author hide
 */
namespace  app\modules\media\widzets\last;

use yii\base\Widget;
use yii\helpers\Html;
use app\modules\media\models\Files;
use Yii;

class LastWidget extends Widget
{
    public $limit=10;
    public $title='';
    public $foto;
    public $class='default';

    public function init()
    {
       
       $files = Files::findBySql('SELECT big_small FROM in_files ORDER BY RAND() LIMIT 1')->one();
       if($files !== null){
       $this->foto =$files->big_small;
       }
       else{
           $this->foto ='foto';
       }
        
    }

    public function run()
    {
      return  $this->render('widzet',['foto'=>$this->foto,'title'=>$this->title,'class'=>$this->class]);
         
    }
}