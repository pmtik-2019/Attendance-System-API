<?php

use yii\db\Migration;

/**
 * Handles the creation of table `intruksi`.
 */
class m190124_070842_create_intruksi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('intruksi', [
            'id_instruksi' => $this->primaryKey(),
            'judul' => $this->text()->notNull(),
            'deskripsi' => $this->text()->notNull(),
            'gambar' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('intruksi');
    }
}
