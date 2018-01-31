<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_work".
 *
 * @property integer $id
 * @property string $name
 * @property integer $disabled
 */
class CategoryWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disabled'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'disabled' => 'Disabled',
        ];
    }
}
