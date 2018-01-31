<?php

namespace common\models;

use Yii;
use dosamigos\transliterator\TransliteratorHelper;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $user_id_from
 * @property integer $user_id_to
 * @property string $text
 * @property string $attachment
 * @property string $publish
 */
class Message extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id_from', 'user_id_to'], 'integer'],
            [['text'], 'string'],
            [['publish'], 'safe'],
            [['attachment'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id_from' => 'User Id From',
            'user_id_to' => 'User Id To',
            'text' => 'Ваш текст',
            'attachment' => 'Вложение',
            'publish' => 'Опубликовано',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('../web/uploads/attachment/' . TransliteratorHelper::process($this->file->baseName, '', 'en') . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getUserName()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_from']);
    }

    public static function hasMessage($user_id)
    {
        $message = Message::find()->where(['user_id_to' => $user_id])->count();
        return $message ? true : false;
    }
}
