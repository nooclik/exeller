<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\StatusBehavior;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property string $category
 * @property string $post
 * @property string $status
 * @property string $publish
 */
class Vacancy extends \yii\db\ActiveRecord
{
    public $type;
    public $sait;
    public $full_description;
    public $email;
    public $phone;
    public $contact_person;
    public $charge;

    const STATUS_ACTIVE = 'Актуальная';
    const STATUS_CLOSE = 'Закрыта';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['publish'], 'safe'],
            [['email'], 'email'],
            [['user_id', 'category'], 'integer'],
            [['type', 'post', 'status'], 'string', 'max' => 25],
            [['name', 'contact_person', 'phone'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 25],
            [['price', 'experience'], 'number'],
            [['sait'], 'string', 'max' => 50],
            [['city'], 'string', 'max' => 25],
            [['full_description'], 'string', 'max' => 1000],
            [['charge'], 'string', 'max' => 1000],
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
            'type' => 'Тип компании',
            'name' => 'Название',
            'description' => 'Описание',
            'category' => 'Категория',
            'post' => 'Должность',
            'status' => 'Статус',
            'publish' => 'Опубликовано',
            'price' => 'Заработная плата',
            'experience' => 'Стаж работы',
            'sait' => 'Сайт компании',
            'phone' => 'Телефон',
            'contact_person' => 'Контактное лицо',
            'city' => 'Город',
            'charge' => 'Обязанности',
            'full_description' => 'Условия',
        ];
    }

    public static function hasVacancy($user_id) //Иммет ли пользователь созданные вакансии
    {
        $my_vacancy = Vacancy::find()->where(['user_id' => $user_id])->count();
        return $my_vacancy == 0 ? false : true;
    }

    public function getCategorys()
    {
        return $this->hasOne(CategoryWork::className(), ['id' => 'category']);
    }

    public static function isOwner($post_id, $user_id) //Является ли пользователь владельцем
    {
        $owner = Vacancy::find()->where(['id' => $post_id, 'user_id' => $user_id])->count();
        return $owner == 0 ? false : true;
    }
}
