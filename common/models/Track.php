<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "track".
 *
 * @property integer $id
 * @property string $points
 * @property integer $use_id
 * @property integer $start
 * @property integer $finish
 * @property string $status
 * @property string $update
 * @property string $publish
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['use_id'], 'integer'],
            [['update', 'publish', 'date_start'], 'safe'],
            [['points', 'detail'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 25],
            [['start', 'finish'],'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'points' => 'Точки',
            'use_id' => 'Use ID',
            'date_start' => 'Дата отправления',
            'action' => 'Действие',
            'start' => 'Отправление',
            'finish' => 'Назначение',
            'detail' => 'Описание',
            'status' => 'Статус',
            'update' => 'Обновлено',
            'publish' => 'Опубликовано',
        ];
    }
}
