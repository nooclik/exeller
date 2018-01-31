<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoryWork */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-work-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
