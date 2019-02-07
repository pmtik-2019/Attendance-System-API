<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id_admin
 * @property string $username
 * @property string $password_admin
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_admin'], 'required'],
            [['username'], 'string', 'max' => 50],
            [['password_admin'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_admin' => 'Id Admin',
            'username' => 'Username',
            'password_admin' => 'Password Admin',
        ];
    }

    public function beforeSave($insert)
    {
        $this->password_maganger = Yii::$app->getSecurity()->generatePasswordHash($this->password_maganger);
    
        return parent::beforeSave($insert);
    }
}
