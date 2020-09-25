<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property string $position
 * @property string $place
 * @property string|null $description
 *
 * @property Experience[] $experiences
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'place'], 'required'],
            [['description'], 'string'],
            [['position'], 'string', 'max' => 64],
            [['place'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
            'place' => 'Place',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Experiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::class, ['id_job' => 'id']);
    }
}
