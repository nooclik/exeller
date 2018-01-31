<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionService */

$this->title = 'Изменить рубрику: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="section-service-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
