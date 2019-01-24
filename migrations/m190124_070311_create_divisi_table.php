<?php

use yii\db\Migration;

/**
 * Handles the creation of table `divisi`.
 */
class m190124_070311_create_divisi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('divisi', [
            'kode_divisi' => $this->char(1),
            'nama_divisi' => $this->string(50)->notNull(),
        ]);

        $this->addPrimaryKey('divisi_pk', 'divisi', 'kode_divisi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('divisi');
    }
}
