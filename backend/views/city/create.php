<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Новый город';
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region,
    ]) ?>

</div>
