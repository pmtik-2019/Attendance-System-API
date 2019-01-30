<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "intruksi".
 *
 * @property int $id_instruksi
 * @property string $judul
 * @property string $deskripsi
 */
class Intruksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intruksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul', 'deskripsi', 'gambar'], 'required'],
            [['judul', 'deskripsi'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_instruksi' => 'Id Instruksi',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
