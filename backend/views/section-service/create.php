<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SectionService */

$this->title = 'Создать рубрику';
$this->params['breadcrumbs'][] = ['label' => 'Рубрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-service-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
