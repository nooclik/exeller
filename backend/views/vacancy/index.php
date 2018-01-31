<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вакансии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'category',
            //'description:ntext',
            'post',
            'price',
            // 'city',
            // 'experience',
            // 'user_id',
            // 'status',
            // 'publish',
            // 'update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
