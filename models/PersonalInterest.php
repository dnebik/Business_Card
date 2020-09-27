<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_interest".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_interest
 *
 * @property Interests $interest
 * @property User $user
 */
class PersonalInterest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_interest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_interest'], 'required'],
            [['id_user', 'id_interest'], 'integer'],
            [['id_interest'], 'exist', 'skipOnError' => true, 'targetClass' => Interests::class, 'targetAttribute' => ['id_interest' => 'id']],
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
            'id_interest' => 'Id Interest',
        ];
    }

    /**
     * Gets query for [[Inerest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterest()
    {
        return $this->hasOne(Interests::class, ['id' => 'id_interest']);
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

    public static function getUserInterests(User $user) {
        return self::find()->joinWith(['interest'])->where(['id_user' => $user])->asArray()->all();
    }

    public static function deleteAllFromUser(User $user) {
        return self::deleteAll(['id_user' => $user->id]);
    }

    public static function addInterest(User $user, string $text) {
        if ($text) {
            $interest = Interests::getInterestByName($text);
            if (!$interest) {
                $interest = new Interests();
                $interest->name = $text;
                $interest->save();
            }
            $personal_interest = new self;
            $personal_interest->id_user = $user->id;
            $personal_interest->id_interest = $interest->id;
            $personal_interest->save();
            return $personal_interest;
        }
    }

    public static function saveInterests(User $user, array $interests) {
        PersonalInterest::deleteAllFromUser($user);
        foreach ($interests as $interest) {
            self::addInterest($user, $interest);
        }
        return self::findAll(['id_user' => $user->id]);
    }
}
