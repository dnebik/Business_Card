<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $login
 * @property string $password
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property string $social
 * @property string $git
 *
 * @property LanguageKnowledge[] $languageKnowledges
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function getCareer()
    {
        return $this->hasOne(Career::class, ['id_user' => 'id']);
    }

    public function getLanguages() {
        return $this->hasMany(LanguageKnowledge::class, ['id_user' => 'id']);
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
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function hasLanguage($language) {
//        error_log("hasLang: " . print_r($language, true));
//        error_log("lang type: " . print_r(get_class($language), true));
//        error_log("Languages class: " . print_r(Languages::class, true));
        if (get_class($language) == Languages::class) {
            return LanguageKnowledge::findOne(['id_user' => $this->id, 'id_language' => $language->id]);
        }
        return null;
    }
}
