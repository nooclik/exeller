<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SectionServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рубрики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-service-index">

    <p>
        <?= Html::a('Создать рубрику', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'thumbnail',
            'disabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
