<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_interest".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_inerest
 *
 * @property Interests $inerest
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
            [['id_user', 'id_inerest'], 'required'],
            [['id_user', 'id_inerest'], 'integer'],
            [['id_inerest'], 'exist', 'skipOnError' => true, 'targetClass' => Interests::class, 'targetAttribute' => ['id_inerest' => 'id']],
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
            'id_inerest' => 'Id Inerest',
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
}
