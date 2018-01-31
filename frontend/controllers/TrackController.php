<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 20.11.2017
 * Time: 9:44
 */

namespace frontend\controllers;

use common\models\Track;
use yii\web\Controller;
use common\models\Directory;

class TrackController extends Controller
{

    public function actionIndex()
    {
        $model = Track::find()->orderBy('publish');
        return $this->render('index', compact('model'));
    }

    public function actionCreate()
    {
        $model = new Track();
        $city = Directory::GetCity();
        $modelPoints = $model->points;
        return $this->render('create', compact('model', 'city', 'modelPoints'));
    }

}