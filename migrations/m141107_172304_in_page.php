<?php

use yii\db\Schema;
use yii\db\Migration;

class m141107_172304_in_page extends Migration
{
    public function up()
    {
       $this->createTable('in_page', [
            'page_id' => 'pk',
            'category_id'=>Schema::TYPE_INTEGER.  ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'topic' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'meta' =>  Schema::TYPE_STRING. ' NOT NULL',
            'meta_tags' =>  Schema::TYPE_STRING. ' NOT NULL',
            'show' =>  Schema::TYPE_SMALLINT. ' NOT NULL',
            'created'=>Schema::TYPE_DATETIME.' NOT NULL',
            'update'=>Schema::TYPE_DATETIME.' NOT NULL',
            'view'=>Schema::TYPE_BIGINT. ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m141107_172304_in_page cannot be reverted.\n";

        return false;
    }
}
