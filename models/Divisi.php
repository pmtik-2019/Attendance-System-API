<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "divisi".
 *
 * @property string $kode_divisi
 * @property string $nama_divisi
 *
 * @property Maganger[] $magangers
 */
class Divisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'divisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_divisi', 'nama_divisi'], 'required'],
            [['kode_divisi'], 'string', 'max' => 1],
            [['nama_divisi'], 'string', 'max' => 50],
            [['kode_divisi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_divisi' => 'Kode Divisi',
            'nama_divisi' => 'Nama Divisi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMagangers()
    {
        return $this->hasMany(Maganger::className(), ['kode_divisi' => 'kode_divisi']);
    }
}
