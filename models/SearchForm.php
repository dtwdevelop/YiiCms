<?php
namespace app\models;
use Yii;
use yii\base\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchForm
 *
 * @author hide
 */
class SearchForm extends Model {
    public $q;
    public  $type;
    public static $types = ['1'=>'User','2'=>'Category','3'=>'Media'];
     public function rules()
    {
        return [
            // username and password are both required
            [['q','type'], 'required'],
           
            
           
        ];
    }
    public function getType(){
        
        return self::$types;
    }

    public function attributeLabels()
    {
        return [
            'q' => Yii::t('app', 'Search'),
            'type'=>Yii::t('app','Criteria'),
            
        ];
    }
}
