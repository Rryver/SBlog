<?php

use yii\db\Migration;

/**
 * Class m210608_140241_add_column_to_table_comment
 */
class m210608_140241_add_column_to_table_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('comment', 'post_id', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('comment', 'post_id');
    }
}
