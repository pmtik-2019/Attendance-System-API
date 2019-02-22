<?php

use yii\db\Migration;

/**
 * Class m190222_062105_change_type_typedef_to_boolean
 */
class m190222_062105_change_type_typedef_to_boolean extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('absensi', 'status_kedatangan', 'boolean');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190222_062105_change_type_typedef_to_boolean cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_062105_change_type_typedef_to_boolean cannot be reverted.\n";

        return false;
    }
    */
}
