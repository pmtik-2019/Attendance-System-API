<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m190124_070739_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id_admin' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password_admin' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin');
    }
}
