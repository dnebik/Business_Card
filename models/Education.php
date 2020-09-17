<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property int $id
 * @property int $id_faculty
 * @property int $id_university
 * @property int $year_start
 * @property int $year_end
 * @property int $id_user
 *
 * @property Faculty $faculty
 * @property University $university
 * @property User $user
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_faculty', 'id_university', 'year_start', 'year_end', 'id_user'], 'required'],
            [['id_faculty', 'id_university', 'year_start', 'year_end', 'id_user'], 'integer'],
            [['id_faculty'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::class, 'targetAttribute' => ['id_faculty' => 'id']],
            [['id_university'], 'exist', 'skipOnError' => true, 'targetClass' => University::class, 'targetAttribute' => ['id_university' => 'id']],
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
            'id_faculty' => 'Id Faculty',
            'id_university' => 'Id University',
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Faculty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::class, ['id' => 'id_faculty']);
    }

    /**
     * Gets query for [[University]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniversity()
    {
        return $this->hasOne(University::class, ['id' => 'id_university']);
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

    public static function getUserEducation(User $user) {
        return self::find()->joinWith(['university', 'faculty'])->where(['id_user' => $user])->asArray()->all();
    }
}
