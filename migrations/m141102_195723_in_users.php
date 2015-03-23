<?php

use yii\db\Schema;
use yii\db\Migration;

class m141102_195723_in_users extends Migration
{
    //yii migrate
    //yii migrate/create
    //yii migrate/up 1
    public function up()
    {
        $this->createTable('in_users', [
            'id' => 'pk',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'authKey' =>  Schema::TYPE_STRING. ' NOT NULL',
            'accessToken' =>  Schema::TYPE_STRING. ' NOT NULL'
        ]);
       
    }

    public function down()
    {
        echo "m141102_195723_in_users cannot be reverted.\n";

        return false;
    }
}
