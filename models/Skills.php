<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonalSkills[] $personalSkills
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skills';
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
     * Gets query for [[PersonalSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalSkills()
    {
        return $this->hasMany(PersonalSkills::class, ['id_skill' => 'id']);
    }

    public static function getSkillByName(string $name) {
        return self::findOne(['name' => $name]);
    }
}
