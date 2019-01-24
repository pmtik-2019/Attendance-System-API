<?php

use yii\db\Migration;

/**
 * Handles the creation of table `absensi`.
 * Has foreign keys to the tables:
 *
 * - `nim`
 */
class m190124_071047_create_absensi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('absensi', [
            'id_absensi' => $this->primaryKey(),
            'status_kedatangan' => $this->integer(1)->notNull(),
            'tanggal_waktu' => $this->datetime()->notNull(),
            'laporan_kerja' => $this->text(),
            'nim' => $this->char(8),
        ]);

        // creates index for column `nim`
        $this->createIndex(
            'idx-absensi-nim',
            'absensi',
            'nim'
        );

        // add foreign key for table `nim`
        $this->addForeignKey(
            'fk-absensi-nim',
            'absensi',
            'nim',
            'maganger',
            'nim',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `nim`
        $this->dropForeignKey(
            'fk-absensi-nim',
            'absensi'
        );

        // drops index for column `nim`
        $this->dropIndex(
            'idx-absensi-nim',
            'absensi'
        );

        $this->dropTable('absensi');
    }
}
