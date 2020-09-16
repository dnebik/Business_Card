<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(["accessToken" => $token])->one();
    }

    public static function findByLogin($login)
    {
        return self::find()->where(["login" => $login])->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        error_log("VALIDATE_PASSWORD: " . Yii::$app->security->validatePassword($password, $this->password));
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
