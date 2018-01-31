<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ResumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'post') ?>

    <?= $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'institution') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'publish') ?>

    <?php // echo $form->field($model, 'update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
