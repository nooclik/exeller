<?php

namespace frontend\modules\api\models;

use frontend\modules\api\models\ServiceCategory;
use common\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $category
 * @property string $short_description
 * @property string $description
 * @property string $date_to_date_after
 * @property string $date_to_date_before
 * @property string $date_to_time_after
 * @property string $date_to_time_before
 * @property integer $city_id
 * @property string $customer_info
 * @property string $address
 * @property string $payment_id
 * @property string $price
 * @property string $attachment
 */
class Service extends ActiveRecord
{
    const STATUS_ACTIVE = 'Активна';
    const STATUS_CLOSE = 'Закрыта';
    const STATUS_DONE = 'Выполнена';
    const STATUS_SELECTED = 'Исполнитель выбран';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_id', 'category'], 'integer'],
            [['description', 'city'], 'string'],
            [['date_to_date_after', 'date_to_date_before', 'date_to_time_after', 'date_to_time_before', 'publish'], 'safe'],
            [['price'], 'number'],
            [['status'], 'string', 'max' => 25],
            [['short_description', 'customer_info', 'address', 'attachment'], 'string', 'max' => 255],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title' => 'short_description',
            //'category' => 'categoryName',
            //'status',
            'price',
            //'city',
        ];
    }

    /**
     * @inheritdoc
     */


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategoryName()
    {
        return $this->hasOne(ServiceCategory::className(), ['id' => 'category']);
    }
}
