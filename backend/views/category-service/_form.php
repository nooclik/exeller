<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => 'autofocus']) ?>

    <?= $form->field($model, 'section_id')->dropDownList($section) ?>

    <?= $form->field($model, 'disabled')->dropDownList([0 => 'Отображать', 1 => 'Скрывать']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class' => 'btn btn-link']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
