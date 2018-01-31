<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'user.nicename',
            'short_description',
            //'description:ntext',
            // 'date_to_date_before',
            // 'date_to_date_after',
            // 'date_to_time_before',
            // 'date_to_time_after',
            // 'city',
            // 'customer_info',
            // 'address',
            // 'payment_id',
            // 'price',
            // 'attachment',
            'status',
            // 'publish',
            // 'update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
