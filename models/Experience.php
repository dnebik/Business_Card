<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "experience".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_job
 * @property int $year_start
 * @property int|null $year_end
 *
 * @property Job $job
 * @property User $user
 */
class Experience extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_job', 'year_start'], 'required'],
            [['id_user', 'id_job', 'year_start', 'year_end'], 'integer'],
            [['id_job'], 'exist', 'skipOnError' => true, 'targetClass' => Job::class, 'targetAttribute' => ['id_job' => 'id']],
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
            'id_job' => 'Id Job',
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'id_job']);
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

    public static function getUserExperience(User $user) {
        return self::find()->joinWith('user')->where(['id_user' => $user->id])->asArray()->all();
    }
}
