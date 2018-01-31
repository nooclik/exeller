<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\models\VacancySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['job-list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name')->widget(Typeahead::classname(), [
        'options' => ['placeholder' => 'Введите для поиска'],
        'pluginOptions' => ['highlight' => true],
        'dataset' => [['local' => $post,]]]) ?>

    <?= $form->field($model, 'category')->widget(Select2::classname(), [
        'data' => $category,
        'options' => ['placeholder' => 'Выберите категори...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);  ?>

    <?= $form->field($model, 'city')->widget(Select2::classname(), [
        'data' => $city,
        'options' => ['placeholder' => 'Выберите город...', 'id' => 's_city'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);  ?>

    <?= $form->field($model, 'price')->input('number', ['placeholder' => $minPrice, 'min' => $minPrice])->label("Зарплата от") ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'publish') ?>

    <?php // echo $form->field($model, 'update') ?>

    <div class="form-group">
        <?= Html::submitButton('Отобрать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', Url::to(['work/job-list']), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
