<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 13.08.2017
 * Time: 14:23
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\typeahead\Typeahead;

$this->title = 'Создать резюме';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'user_id')->textInput(['type' => 'hidden'])->label(''); ?>

        <?= $form->field($model, 'category')->dropDownList($category); ?>
        <?= $form->field($model, 'post')->textInput(['placeholder' => 'Желаемая должность...']) ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'salary')->textInput(['type' => 'number', 'min' => '0']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'experience')->textInput(['type' => 'number', 'min' => '0']) ?>
            </div>
        </div>
        <?= $form->field($model, 'education')->dropDownList($education) ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'age')->textInput(['type' => 'number', 'min' => '18',]); ?>
            </div>
        </div>

        <?= $form->field($model, 'skills')->widget(Select2::classname(), [
            'options' => ['placeholder' => 'Введите навыки через запятую...', 'multiple' => true],
            'showToggleAll' => false,
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',',],
                'maximumInputLength' => 100,
            ],
        ])->label('Основные навыки')->hint('Перечислите чере запятую'); ?>

        <?= $form->field($model, 'sex')->radioList($sex) ?>
        <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [['local' => $city,]]]) ?>
        <h4>Основное образование</h4>
        <?= $form->field($model, 'place_study') ?>
        <?= $form->field($model, 'faculty') ?>
        <?= $form->field($model, 'speciality') ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'year')->textInput(['type' => 'number']) ?>
            </div>
        </div>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right']); ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
