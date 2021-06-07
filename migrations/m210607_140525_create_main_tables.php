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
//        $tableOptions = null;
//        if ($this->db->driverName === 'mysql') {
//            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
//            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
//        }

        $this->createTable('post', [
            'id' => Schema::TYPE_PK,
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'created_at' => Schema::TYPE_DATE,
            'updated_at' => Schema::TYPE_DATE,
            ]);

        $this->createTable()
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('post');
    }
}
