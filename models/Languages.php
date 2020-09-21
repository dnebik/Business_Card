<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $name
 *
 * @property LanguageKnowledge[] $languageKnowledges
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 16],
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
        return $this->hasMany(LanguageKnowledge::class, ['id_language' => 'id']);
    }

    public static function exist(string $language) {
        return self::findOne(['name' => $language]);
    }
}
