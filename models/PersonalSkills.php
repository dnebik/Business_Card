<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_skills".
 *
 * @property int $id
 * @property int $id_skill
 * @property int $id_user
 * @property int $percent
 *
 * @property Skills $skill
 * @property Users $user
 */
class PersonalSkills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_skill', 'id_user', 'percent'], 'required'],
            [['id_skill', 'id_user', 'percent'], 'integer'],
            [['id_skill'], 'exist', 'skipOnError' => true, 'targetClass' => Skills::class, 'targetAttribute' => ['id_skill' => 'id']],
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
            'id_skill' => 'Id Skill',
            'id_user' => 'Id User',
            'percent' => 'Percent',
        ];
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skills::class, ['id' => 'id_skill']);
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

    public static function getAllUserSkills(User $user) {
        return self::find()->joinWith('skill')->where(['id_user' => $user->id])->orderBy('percent DESC')->asArray()->all();
    }
}
