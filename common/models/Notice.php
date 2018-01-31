<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notice_user".
 *
 * @property integer $id
 * @property string $notice
 * @property integer $user_id
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['notice'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notice' => 'Notice',
            'user_id' => 'User ID',
        ];
    }
}
