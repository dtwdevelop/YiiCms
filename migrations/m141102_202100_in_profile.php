<?php

use yii\db\Schema;
use yii\db\Migration;

class m141102_202100_in_profile extends Migration
{
    public function up()
    {
          $this->createTable('in_profile', [
            'profile_id' => 'pk',
            'user_id'=>Schema::TYPE_INTEGER.  ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role'=>Schema::TYPE_STRING.' NOT NULL',
//            'profile_pic'=>Schema::TYPE_STRING.' NOT NULL',
            'active' =>  Schema::TYPE_SMALLINT. ' NOT NULL',
            'ban' =>  Schema::TYPE_SMALLINT. ' NOT NULL',
            'created'=>Schema::TYPE_DATETIME.' NOT NULL',
            'update'=>Schema::TYPE_DATETIME.' NOT NULL',
            'last_login'=>Schema::TYPE_DATETIME.' NOT NULL',
            'online'=>Schema::TYPE_SMALLINT.' NOT NULL',
        ]);


    }

    public function down()
    {
        echo "m141102_202100_in_profile cannot be reverted.\n";

        return false;
    }
}
