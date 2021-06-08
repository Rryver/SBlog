<?php

use yii\db\Migration;

/**
 * Class m210608_081226_insert_admin_user
 */
class m210608_081226_insert_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->insert('user', [
            'username' => 'admin',
            'auth_key' => 'lJANBQLtYrsmy3Esa8kdBYCCizzsxvuJ',
            'password_hash' => '$2y$13$mg3FpAU4XIZkEyL7WUaScu3TF0elXpUv9rqD3IFHrTs/6ZP//LJEi',
            'email' => 'admin@example.com',
            'status' => 10,
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'verification_token' => 'IqzSbp5Cy16nWsGv-NTK1ZzKbcGuin8Z_1623138206',
            'isAdmin' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->delete('user',['username' => 'admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_081226_insert_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
