<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = 'Изменить: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Методы оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="payment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
