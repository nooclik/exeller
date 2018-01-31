<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'category')->dropDownList($category) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_to_date_before')->textInput() ?>

    <?= $form->field($model, 'date_to_date_after')->textInput() ?>

    <?= $form->field($model, 'date_to_time_before')->textInput() ?>

    <?= $form->field($model, 'date_to_time_after')->textInput() ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($status) ?>

    <?= $form->field($model, 'publish')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class' => 'btn btn-link', 'data-confirm' => 'Вы уверены?']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
