<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\StatusBehavior;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $category
 * @property string $post
 * @property string $salary
 * @property string $experience
 * @property string $education
 * @property string $institution
 * @property integer $age
 * @property string $sex
 * @property string $city
 * @property string $status
 * @property string $publish
 */
class Resume extends \yii\db\ActiveRecord
{
     public $place_study;
     public $faculty;
     public $speciality;
     public $year;
     public $name;

     const STATUS_ACTIVE = 'Актуально';
     const STATUS_CLOSE = 'Закрыта';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resume';
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
            [['user_id', 'category' ], 'integer'],
            [['age'], 'integer', 'min' => 18, 'message' => 'dasdasd'],
            [['salary', 'experience'], 'number'],
            [['publish', 'skills', 'year'], 'safe'],
            [['education', 'city', 'status'], 'string', 'max' => 25],
            [['post', 'place_study', 'faculty', 'speciality'], 'string', 'max' => 255],
            [['institution'], 'string', 'max' => 1000],
            [['sex'], 'string', 'max' => 10],
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
            'post' => 'Должность',
            'salary' => 'Заработная плата',
            'experience' => 'Стаж работы',
            'education' => 'Образование',
            'institution' => 'Учреждение',
            'age' => 'Возраст',
            'sex' => 'Пол',
            'city' => 'Город',
            'status' => 'Статус',
            'publish' => 'Опубликовано',
            'place_study' => 'Учебное заведение',
            'faculty' => 'Факультет',
            'speciality' => 'Специализация',
            'year' => 'Год окончания',
            'skills' => 'Навыки',
        ];
    }

    public function getCategorys()
    {
        return $this->hasOne(CategoryWork::className(), ['id' => 'category']);
    }

    public static function hasResume($user_id) //Имеет ли пользователь созданные резюме
    {
        $my_resume = Resume::find()->where(['user_id' => $user_id])->count();
        return $my_resume == 0 ? false : true;
    }
}
