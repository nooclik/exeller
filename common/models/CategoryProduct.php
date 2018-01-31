<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $disabled
 */
class CategoryProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disabled'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
