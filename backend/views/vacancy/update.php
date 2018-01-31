<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancy */

$this->title = 'Изменить вакансию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вакансии', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="vacancy-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
