<?php

use yii\db\Schema;
use yii\db\Migration;

class m141111_104939_in_files extends Migration
{
    public function up()
    {
       $this->createTable('in_files', [
            'file_id' => 'pk',
            'media_id'=>Schema::TYPE_INTEGER.  ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'big_foto'=>  Schema::TYPE_STRING. ' NOT NULL',
            'big_small'=>  Schema::TYPE_STRING. ' NOT NULL',
            'topic' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'meta' =>  Schema::TYPE_STRING. ' NOT NULL',
            'meta_tags' =>  Schema::TYPE_STRING. ' NOT NULL',
            'meta_tags' =>  Schema::TYPE_STRING. ' NOT NULL',
            'show' =>  Schema::TYPE_SMALLINT. ' NOT NULL',
            'created'=>Schema::TYPE_DATETIME.' NOT NULL',
            'like'=>Schema::TYPE_BIGINT. ' NOT NULL',
            'view'=>Schema::TYPE_BIGINT. ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m141111_104939_in_files cannot be reverted.\n";

        return false;
    }
}
