<?php

use yii\db\Schema;
use yii\db\Migration;

class m141128_101454_in_rating extends Migration
{
    public function up()
    {
         $this->createTable('in_rating', [
            'rate_id' => 'pk',
            'user_id'=>Schema::TYPE_INTEGER.  ' NOT NULL',
            'foto_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rating' => Schema::TYPE_INTEGER . ' NOT NULL',
            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'rating' => Schema::TYPE_STRING . ' NOT NULL',
            'created'=>Schema::TYPE_DATETIME.' NOT NULL',
           
            
        ]);
    }

    public function down()
    {
        echo "m141128_101454_in_rating cannot be reverted.\n";

        return false;
    }
}
