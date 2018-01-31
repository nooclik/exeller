<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "complaint".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $motive
 * @property string $publish
 */
class Complaint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['motive'], 'required', 'message' => 'Это поле не может быть пустым, укажите причину'],
            [['post_id', 'user_id'], 'integer'],
            [['publish'], 'safe'],
            [['motive'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'motive' => 'Причина',
            'publish' => 'Publish',
        ];
    }
}
