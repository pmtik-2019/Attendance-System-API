<?php

use yii\db\Migration;

/**
 * Class m190222_062039_clean_absensi_tables
 */
class m190222_062039_clean_absensi_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('absensi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190222_062039_clean_absensi_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_062039_clean_absensi_tables cannot be reverted.\n";

        return false;
    }
    */
}
