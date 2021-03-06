<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section_service".
 *
 * @property integer $id
 * @property string $name
 * @property string $thumbnail
 * @property string $disabled
 */
class SectionService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $attr_name;
    public $attr_type;
    public $attr_label;

    public static function tableName()
    {
        return 'section_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disabled'], 'integer'],
            [['name', 'thumbnail'], 'string', 'max' => 50],
            [['attr_name', 'attr_type', 'attr_label'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'thumbnail' => 'Изображение',
            'disabled' => 'Состояние',
        ];
    }
}
