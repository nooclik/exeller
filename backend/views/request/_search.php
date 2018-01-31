<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'date_to_date_before') ?>

    <?php // echo $form->field($model, 'date_to_date_after') ?>

    <?php // echo $form->field($model, 'date_to_time_before') ?>

    <?php // echo $form->field($model, 'date_to_time_after') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'customer_info') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'payment_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'attachment') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'publish') ?>

    <?php // echo $form->field($model, 'update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
