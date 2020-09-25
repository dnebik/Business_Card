<?php

namespace app\models;

use http\Encoding\Stream;
use Yii;
use app\models\User;

/**
 * This is the model class for table "language_knowledge".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_language
 * @property int $id_level
 *
 * @property Languages $language
 * @property LevelOfKnowledge $level
 * @property User $user
 */
class LanguageKnowledge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language_knowledge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_language', 'id_level'], 'required'],
            [['id_user', 'id_language', 'id_level'], 'integer'],
            [['id_language'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::class, 'targetAttribute' => ['id_language' => 'id']],
            [['id_level'], 'exist', 'skipOnError' => true, 'targetClass' => LevelOfKnowledge::class, 'targetAttribute' => ['id_level' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_language' => 'Id Language',
            'id_level' => 'Id Level',
        ];
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'id_language']);
    }

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(LevelOfKnowledge::class, ['id' => 'id_level']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }

    public static function getAllUserKnowledge (User $user) {
        return self::find()->joinWith(['level', 'language'])->where(['id_user' => $user->id])->asArray()->all();
    }

    public static function deleteAllFromUser(User $user) {
        return self::deleteAll(['id_user' => $user->id]);
    }

    public static function addKnowledge(User $user, string $lang, LevelOfKnowledge $level) {
        if ($lang) {

            $language = Languages::getByName($lang);
            $language_know = new LanguageKnowledge();

            if (!$language) {
                $language = new Languages();
                $language->name = $lang;
                $language->save();
            }

            $language_know->id_user = $user->id;
            $language_know->id_language = $language->id;
            $language_know->id_level = $level->id;

            return $language_know->save();
        }
    }
}
