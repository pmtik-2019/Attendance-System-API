<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maganger".
 *
 * @property string $nim
 * @property string $nama_maganger
 * @property string $kode_divisi
 * @property string $password_maganger
 * @property int $status_maganger
 *
 * @property Absensi[] $absensis
 * @property Divisi $kodeDivisi
 */
class Maganger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maganger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'nama_maganger', 'password_maganger'], 'required'],
            [['status_maganger'], 'integer'],
            [['nim'], 'string', 'max' => 8],
            [['nama_maganger'], 'string', 'max' => 50],
            [['kode_divisi'], 'string', 'max' => 1],
            [['password_maganger'], 'string', 'max' => 100],
            [['nim'], 'unique'],
            [['kode_divisi'], 'exist', 'skipOnError' => true, 'targetClass' => Divisi::className(), 'targetAttribute' => ['kode_divisi' => 'kode_divisi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nim' => 'Nim',
            'nama_maganger' => 'Nama Maganger',
            'kode_divisi' => 'Kode Divisi',
            'password_maganger' => 'Password Maganger',
            'status_maganger' => 'Status Maganger',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsensis()
    {
        return $this->hasMany(Absensi::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeDivisi()
    {
        return $this->hasOne(Divisi::className(), ['kode_divisi' => 'kode_divisi']);
    }

    public function beforeSave($insert) {

        $this->password_maganger = Yii::$app->getSecurity()->generatePasswordHash($this->password_maganger);
    
        return parent::beforeSave($insert);
    }
}
