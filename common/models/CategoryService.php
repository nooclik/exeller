<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_service".
 *
 * @property integer $id
 * @property string $name
 * @property integer $section_id
 * @property integer $disabled
 */
class CategoryService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'section_id', 'disabled'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['fields'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'section_id' => 'Рубрика',
            'disabled' => 'Состояние',
        ];
    }
}
