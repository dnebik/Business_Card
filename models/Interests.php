<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interests".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonalInterest[] $personalInterests
 */
class Interests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[PersonalInterests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalInterests()
    {
        return $this->hasMany(PersonalInterest::class, ['id_interest' => 'id']);
    }

    public static function getInterestByName(string $interest) {
        return self::findOne(['name' => $interest]);
    }
}
