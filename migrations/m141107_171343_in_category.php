<?php

use yii\db\Schema;
use yii\db\Migration;

class m141107_171343_in_category extends Migration
{
    public function up()
    {
        $this->createTable('in_category', [
            'category_id' => 'pk',
            'parent_id'=>Schema::TYPE_INTEGER.  ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'about' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'meta' =>  Schema::TYPE_STRING. ' NOT NULL',
            'meta_tags' =>  Schema::TYPE_STRING. ' NOT NULL',
            'pos' =>  Schema::TYPE_INTEGER. ' NOT NULL',
            'show' =>  Schema::TYPE_SMALLINT. ' NOT NULL',
            'created'=>Schema::TYPE_DATETIME.' NOT NULL',
            'view'=>Schema::TYPE_BIGINT. ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m141107_171343_in_category cannot be reverted.\n";

        return false;
    }
}
