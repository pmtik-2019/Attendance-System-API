<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absensi".
 *
 * @property int $id_absensi
 * @property int $status_kedatangan
 * @property string $tanggal_waktu
 * @property string $laporan_kerja
 * @property string $nim
 *
 * @property Maganger $nim0
 */
class Absensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_kedatangan', 'tanggal_waktu'], 'required'],
            [['status_kedatangan'], 'integer'],
            [['tanggal_waktu'], 'safe'],
            [['laporan_kerja'], 'string'],
            [['nim'], 'string', 'max' => 8],
            [['nim'], 'exist', 'skipOnError' => true, 'targetClass' => Maganger::className(), 'targetAttribute' => ['nim' => 'nim']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_absensi' => 'Id Absensi',
            'status_kedatangan' => 'Status Kedatangan',
            'tanggal_waktu' => 'Tanggal Waktu  [Y-m-d H:i:s] ' ,
            'laporan_kerja' => 'Laporan Kerja',
            'nim' => 'NIM',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNim0()
    {
        return $this->hasOne(Maganger::className(), ['nim' => 'nim']);
    }
}
