<?php

namespace common\models;

use common\models\User;
use common\models\Deal;
use Yii;
use yii\web\UploadedFile;
use dosamigos\transliterator\TransliteratorHelper;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\StatusBehavior;

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
class Request extends \yii\db\ActiveRecord
{
    public $name;
    const STATUS_ACTIVE = 'Активна';
    const STATUS_CLOSE = 'Закрыта';
    const STATUS_DONE = 'Выполнена';
    const STATUS_SELECTED = 'Исполнитель выбран';

    public $thumnail;

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
            [['thumnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category' => 'Рубрика',
            'short_description' => 'Заголовок',
            'description' => 'Описание работы',
            'date_to_date_after' => 'по',
            'date_to_date_before' => 'Выполнить до',
            'date_to_time_after' => 'по',
            'date_to_time_before' => 'Время с',
            'city' => 'Город',
            'customer_info' => 'Customer Info',
            'address' => 'Адрес',
            'payment_id' => 'Способо оплаты',
            'price' => 'Цена',
            'status' => 'Статус',
            'attachment' => 'Вложение',
            'publish' => 'Опубликовано',
            'thumnail' => 'Изображение',
            'update' => 'Обновлено',
        ];
    }

    public function getUser ()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategory () {
        return $this->hasOne(CategoryService::className(), ['id' => 'category']);
    }

    public function upload() //Загрузка файла
    {
        if ($this->validate()) {
            $this->thumnail->saveAs('../web/uploads/thumbnail/' . TransliteratorHelper::process($this->thumnail->baseName, '', 'en') . '.' . $this->thumnail->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function hasRequest($user_id) //Имеет ли пользователь созданные заявки
    {
        $my_request = Request::find()->where(['user_id' => $user_id])->count();
            return $my_request == 0 ? false : true;
    }

    public static function isContractor ($user_id, $request_id) //Является ли пользователь исполнителем
    {
        $contractor = Deal::find()->where(['contractor_id' => $user_id, 'request_id' => $request_id])->count();
        return $contractor == 0 ? false : true;
    }

    public static function isCustomer ($user_id, $request_id) //Является ли пользователь заказчиком
    {
        $customer = Request::find()->where(['user_id' => $user_id, 'id' => $request_id])->count();
        return $customer ? true : false;
    }

    public static function isDone($request_id) //Проверка выполнена ли заявка
    {
        $request = Request::find()->where(['id' => $request_id, 'status' => Request::STATUS_DONE])->count();
        return $request ? true : false;
    }
}
