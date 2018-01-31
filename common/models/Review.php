<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $contractor_id
 * @property integer $post_id
 * @property string $rewiew
 * @property integer $rating
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rewiew', 'rating'], 'required' ,'message' => 'Необходимо оставить отзыв'],
            [['contractor_id', 'post_id', 'rating'], 'integer'],
            [['rewiew'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contractor_id' => 'Contractor ID',
            'post_id' => 'Post ID',
            'rewiew' => 'Отзыв',
            'rating' => 'Rating',
        ];
    }
}
