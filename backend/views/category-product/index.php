<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-product-index">

    <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'disabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
