<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Delivery */

$this->title = 'Добавить новый';
$this->params['breadcrumbs'][] = ['label' => 'Методы доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
