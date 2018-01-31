<?php

namespace common\models;

use MongoDB\BSON\Timestamp;
use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\StatusBehavior;

/**
 * This is the model class for table "request_product".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $category
 * @property string $short_description
 * @property string $full_description
 * @property string $price
 * @property integer $delivery_id
 * @property integer $count_view
 * @property string $publish
 */
class Product extends \yii\db\ActiveRecord
{
    public $name;
    const STATUS_ACTIVE = 'Актуально';
    const STATUS_CLOSE = 'Не актуально';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_product';
    }

    public function behaviors()
    {
        return [
            'Time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'publish',
                'updatedAtAttribute' => 'update',
                'value' => new Expression('NOW()'),
            ],
            'UserID' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                //'updatedByAttribute' => 'updater_id',
            ],
            'Status' => [
                'class' =>StatusBehavior::className(),
                'status' => 'status',
                'value' => $this::STATUS_ACTIVE,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category', 'delivery_id', 'count_view'], 'integer'],
            [['price'], 'number'],
            [['publish'], 'safe'],
            [['status'], 'string', 'max' => 25],
            [['condition'], 'string', 'max' => 25],
            [['short_description', 'full_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category' => 'Категория',
            'short_description' => 'Наименование товара',
            'full_description' => 'Описание',
            'price' => 'Цена',
            'delivery_id' => 'Способ доставки',
            'status' => 'Статус',
            'count_view' => 'Количество просмотров',
            'publish' => 'Опубликовано',
            'condition' => 'Состояние',
        ];
    }

    public static function hasProduct($user_id) //Имеет ли пользователь созданные заявки на товары
    {
        $my_product = Product::find()->where(['user_id' => $user_id])->count();
        return $my_product == 0 ? false : true;
    }

    public function getCategorys () {
        return $this->hasOne(CategoryProduct::className(), ['id' => 'category']);
    }
}
