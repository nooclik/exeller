<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = 'Добавить метод оплаты';
$this->params['breadcrumbs'][] = ['label' => 'Методы оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
