<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210607_140525_create_main_tables
 */
class m210607_140525_create_main_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('post', [
            'id' => Schema::TYPE_PK,
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'created_at' => Schema::TYPE_DATE,
            'updated_at' => Schema::TYPE_DATE,
            ]);

        $this->createTable('comment', [
            'id' => Schema::TYPE_PK,
            'username' => $this->string(50)->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('post');
        $this->dropTable('comment');
    }
}
