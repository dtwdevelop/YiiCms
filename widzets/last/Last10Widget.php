<?php
namespace app\widzets\last;
use yii\base\Widget;
use yii\helpers\Url;
use app\modules\article\models\Page;
use app\modules\article\models\Categories;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Last10Widget extends Widget
{
    public $title='';
    public $model;
    public $limit=10;

    public function init()
    {
//        $this->model = Page::find(['show'=>1])->limit($this->limit)->all();
        $this->model = Categories::find(['show'=>1])->limit($this->limit)->all();
        
    }

    public function run()
    {
        
        return $this->render('widget',['model'=>$this->model,'title'=>$this->title]);
    }
}
