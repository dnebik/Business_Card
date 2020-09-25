<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level_of_knowledge".
 *
 * @property int $id
 * @property string $name
 *
 * @property LanguageKnowledge[] $languageKnowledges
 */
class LevelOfKnowledge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'level_of_knowledge';
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
     * Gets query for [[LanguageKnowledges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageKnowledges()
    {
        return $this->hasMany(LanguageKnowledge::class, ['id_level' => 'id']);
    }

    public static function getByIdentity(int $id) {
        return self::findOne($id);
    }

    public static function getAllLevels() {
        $languageLevelData = self::find()->select('name')->orderBy('id ASC')->asArray()->all();
        $foo = array();
        foreach ($languageLevelData as $level) {
            array_push($foo, $level['name']);
        }
        return $foo;
    }
}
