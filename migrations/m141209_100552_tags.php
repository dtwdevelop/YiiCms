<?php

use yii\db\Schema;
use yii\db\Migration;

class m141209_100552_tags extends Migration
{
    public function up()
    {
            $this->createTable('in_tags', [
            'rate_id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'fr'=>Schema::TYPE_INTEGER.' NOT NULL',
           
            
        ]);
    }

    public function down()
    {
        echo "m141209_100552_tags cannot be reverted.\n";

        return false;
    }
}
