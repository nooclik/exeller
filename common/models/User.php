<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use dosamigos\transliterator\TransliteratorHelper;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $nicename - имя/фамилия
 * @property string $name - имя
 * @property string $surname - фамилия
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $UNN - УНП
 * @property string $legal_address - юридический адрес
 * @property string $actual_address - фактический адрес
 * @property integer $age - возраст
 * @property string $sex - пол
 * @property string $url_social_network - ссылка на соц сеть
 * @property string $category - основная категория
 * @property string $activity - вид деятельности
 * @property string $organization_form - организационная форма
 * @property string $region - область
 * @property string $street - улица
 * @property string $notice - по каким видам получать уведомления
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $UNN;
    public $legal_address;
    public $actual_address;
    public $age;
    public $sex;
    public $url_social_network;
    public $category;
    public $activity;
    public $organization_form;
    public $region;
    public $day;
    public $month;
    public $year;
    public $foto;
    public $name;
    public $surname;
    public $thumbnail;
    public $notice;
    public $street;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['notice'],'safe'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['UNN', 'legal_address','actual_address','sex', 'age','url_social_network','category',
                'activity','organization_form','region','day', 'month','year', 'activity_data', 'personal_data', 'nicename', 'name', 'surname', 'street', 'city'], 'string'],
            [['foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    static public function getAge($y, $m, $d) {

        if($m > date('m') || $m == date('m') && $d > date('d'))
            return (date('Y') - $y - 1); // если ДР в этом году не было, то ещё -1
        else
            return (date('Y') - $y); // если ДР в этом году был, то отнимаем от этого года год рождения
    }

    public function attributeLabels(){
        return [
            'username' => 'Логин',
            'phone' => 'Телефон',
            'region' => 'Область',
            'city' => 'Город',
            'day' => 'День',
            'month' => 'Месяц',
            'year' => 'Год',
            'sex' => 'Пол',
            'organization_form' => 'Форма',
            'category' => 'Категория',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'nicename' => 'ФИО',
            'street' => 'Улица',
        ];
    }

    public function upload()
    {
       if ($this->validate()) {
            $this->foto->saveAs('../web/uploads/thumbnail/' . TransliteratorHelper::process($this->foto->baseName, '', 'en') . '.' . $this->foto->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function GetRatingAVG($user_id)
    {
        $rating = Yii::$app->db->createCommand('SELECT AVG(rating) FROM review WHERE contractor_id = :user_id')->bindValue(':user_id', $user_id)->queryScalar();
        return $rating;
    }

    public static function GetReview($user_id) {
        $reviews = Yii::$app->db->createCommand('SELECT r.rewiew, r.rating, r.publish, rs.short_description, rs.id AS request_id, u.nicename FROM review r LEFT JOIN request_service rs ON r.post_id = rs.id LEFT JOIN user u ON r.contractor_id = u.id WHERE r.contractor_id = :user_id')->bindValue(':user_id', $user_id)->queryAll();
        return $reviews;
    }

    public static function GetTypesOfWork($user_id){
        $types = Yii::$app->db->createCommand('SELECT rs.category FROM review r LEFT JOIN request_service rs ON r.post_id = rs.id WHERE r.contractor_id = :user_id')->bindValue(':user_id', $user_id)->queryAll();
        return $types;
    }

    public static function InsertNotice ($notices = array(), $user_id) //Сохранить рубрики уведомлений
    {
        foreach ($notices as $notice)
        {
            Yii::$app->db->createCommand()->insert('notice_user', ['notice' => $notice, 'user_id' => $user_id])->execute();
        }
    }

    public static function UserList() {
        $users = ArrayHelper::map(User::find()->select('id, nicename')->orderBy('nicename')->all(), 'id' , 'nicename');

        return $users;
    }
}
