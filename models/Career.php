<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "career".
 *
 * @property int $id
 * @property int $id_user
 * @property string $text
 *
 * @property User $user
 */
class Career extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'career';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'text'], 'required'],
            [['id_user'], 'integer'],
            [['text'], 'string'],
            [['id_user'], 'unique'],
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
            'text' => 'Text',
        ];
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

    public static function getCareerByUser(User $user) {
        return self::findOne(['id_user' => $user->id]);
    }

    public static function saveCareer(User $user, string $text) {
        $career = self::findOne(['id_user' => $user->id]);
        if (!$career) {
            $career = new Career();
            $career->id_user = $user->id;
        }
        $career->text = $text;
        $career->save();
        return $career;
    }

    public static function getUserCareer(User $user) {
        return self::find()->where(['id_user' => $user->id])->asArray()->one();
    }
}
