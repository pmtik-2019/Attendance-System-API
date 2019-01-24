<?php

use yii\db\Migration;

/**
 * Class m190124_073330_add_default_admin_data
 */
class m190124_073330_add_default_admin_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('admin', [
            'username' => 'admin',
            // Creating admin password
            'password_admin' => Yii::$app->getSecurity()->generatePasswordHash('admin')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190124_073330_add_default_admin_data cannot be reverted.\n";

        return false;
    }
    */
}
