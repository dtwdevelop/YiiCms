<?php


namespace app\models;
use yii\base\Model;
class EntryForm extends Model {
    //put your code here
    public $name;
    public $email;
    public  function rules() {
        
       return [
            [['name', 'name'], 'required'],
            ['email', 'email'],
        ];
    }
}
