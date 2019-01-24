<?php

use yii\db\Migration;

/**
 * Handles the creation of table `maganger`.
 * Has foreign keys to the tables:
 *
 * - `kode_divisi`
 */
class m190124_070330_create_maganger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('maganger', [
            'nim' => $this->char(8),
            'nama_maganger' => $this->string(50)->notNull(),
            'kode_divisi' => $this->char(1),
            'password_maganger' => $this->string(100)->notNull(),
            'status_maganger' => (new yii\db\ColumnSchemaBuilder('tinyint', 1, $this->db))->notNull()->defaultValue(1),
        ]);
        
        $this->addPrimaryKey('maganger_pk', 'maganger', 'nim');

        // creates index for column `kode_divisi`
        $this->createIndex(
            'idx-maganger-kode_divisi',
            'maganger',
            'kode_divisi'
        );

        // add foreign key for table `kode_divisi`
        $this->addForeignKey(
            'fk-maganger-kode_divisi',
            'maganger',
            'kode_divisi',
            'divisi',
            'kode_divisi',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `kode_divisi`
        $this->dropForeignKey(
            'fk-maganger-kode_divisi',
            'maganger'
        );

        // drops index for column `kode_divisi`
        $this->dropIndex(
            'idx-maganger-kode_divisi',
            'maganger'
        );

        $this->dropTable('maganger');
    }
}
