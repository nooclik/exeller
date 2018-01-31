<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryService */

$this->title = 'Изменить категорию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-service-update">

    <?= $this->render('_form', [
        'model' => $model,
        'section' => $section,
    ]) ?>

</div>
