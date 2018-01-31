<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SectionService */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-service-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class' => 'btn btn-link']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'thumbnail',
            'disabled',
        ],
    ]) ?>

</div>
