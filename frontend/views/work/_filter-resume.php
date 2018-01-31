<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\ResumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-search" id="filter">

    <?php $form = ActiveForm::begin([
        'action' => ['resume-list'],
        'method' => 'get',
        'options' => ['data-pjax' => true],
    ]); ?>

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

    <?= $form->field($model, 'education')->dropDownList($education, ['prompt' => 'Не имеет значения']) ?>

    <?= $form->field($model, 'sex')->dropDownList($sex, ['prompt' => 'Не имеет значения']) ?>

    <?= $form->field($model, 'age')->input('number', ['placeholder' => $minAge, 'min' => $minAge])->label('Возраст не менее') ?>

    <?= $form->field($model, 'experience')->input('number', ['placeholder' => $minExperience, 'min' => $minExperience])->label('Стаж не менее (лет)') ?>

    <div class="form-group">
        <?= Html::submitButton('Отобрать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', Url::to(['work/resume-list']), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
