<?php

namespace common\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "deal".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $contractor_id
 * @property integer $request_id
 * @property string $status
 */
class Deal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'contractor_id', 'request_id'], 'integer'],
            [['status'], 'string', 'max' => 25],
            [['message'], 'string', 'max' => 255],
            [['publish'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'contractor_id' => 'Contractor ID',
            'request_id' => 'Request ID',
            'status' => 'Status',
            'message' => 'Сообщение',
            'publish' => 'Опубликовано'
        ];
    }

    public function getContractor() {
        return $this->hasOne(User::className(), ['id' => 'contractor_id']);
    }
}
