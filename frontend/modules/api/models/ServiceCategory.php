<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 17.01.2018
 * Time: 23:16
 */

namespace frontend\modules\api\models;


use yii\db\ActiveRecord;

class ServiceCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'category_service';
    }
    public function fields () {
        return [
            'id',
            'name',
        ];
    }

}