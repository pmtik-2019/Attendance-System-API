<?php

namespace app\models;

use Yii;

use app\models\Admin;
use app\models\Maganger;

final class Identity implements \yii\web\IdentityInterface
{
    const TYPE_ADMIN = 'admin';
    const TYPE_MAGANGER = 'maganger';

    const ALLOWED_TYPES = [self::TYPE_ADMIN, self::TYPE_MAGANGER];

    public $username;

    private $_id;
    private $_authkey;
    private $_passwordHash;

    public static function findIdentity($id)
    {
        $parts = explode('-', $id);
        if (\count($parts) !== 2) {
            throw new InvalidCallException('id should be in form of Type-number');
        }
        [$type, $number] = $parts;

        if (!\in_array($type, self::ALLOWED_TYPES, true)) {
            throw new InvalidCallException('Unsupported identity type');
        }

        $model = null;
        switch ($type) {
            case self::TYPE_ADMIN:
                $model = Admin::find()->where(['username' => $number])->one();
                break;
            case self::TYPE_MAGANGER:
                $model = Maganger::find()->where(['nim' => $number])->one();
                break;
        }

        if ($model === null) {
            return false;
        }

        $identity = new Identity();
        $identity->_id = $id;
        $identity->_authkey = null;
        
        if ($type == self::TYPE_ADMIN) {
            $identity->_passwordHash = $model->password_admin;
            $identity->username = $model->username;
        } else {
            $identity->_passwordHash = $model->password_maganger;
            $identity->username = $model->nim;
        }

        $identity->_type = $type;

        return $identity;
    }

    public static function findIdentityByUsername($login_as, $username)
    {
        $id = null;

        if ($login_as == 0) {
            $model = Maganger::find()->where(['nim' => $username])->one();
        } else {
            $model = Admin::find()->where(['username' => $username])->one();
        }

        if (!$model) {
            return false;
        }

        if ($login_as == 0) {
            $id = $model->nim;
        } else {
            $id = $model->username;
        }

        if ($model instanceof Maganger) {
            $type = self::TYPE_MAGANGER;
        } else {
            $type = self::TYPE_ADMIN;
        }

        $identity = new Identity();
        $identity->_id = $type . '-' . $id;
        $identity->_authkey = null;

        if ($type == self::TYPE_ADMIN) {
            $identity->_passwordHash = $model->password_admin;
        } else {
            $identity->_passwordHash = $model->password_maganger;
        }
        return $identity;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return false;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->_passwordHash);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthKey()
    {
        return $this->_authkey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
