<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 17.01.2018
 * Time: 22:11
 */

namespace frontend\modules\api\controllers;
use frontend\modules\api\models\Service;

use yii\rest\ActiveController;

class ServiceController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Service';
}