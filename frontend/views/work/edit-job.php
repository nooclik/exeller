<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 18.08.2017
 * Time: 23:31
 */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\typeahead\Typeahead;
use dosamigos\ckeditor\CKEditor;

$this->title = 'Создать вакансию';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'category')->dropDownList($category) ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'type')->dropDownList($company_type) ?>
            </div>
        </div>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'post')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [['local' => $post,]]]) ?>

        <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [['local' => $city,]]]) ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => 0]) ?>
                <?= $form->field($model, 'experience')->textInput(['type' => 'number', 'min' => 0]) ?>
            </div>
        </div>
        <?= $form->field($model, 'full_description')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'custom'
        ]) ?>
        <?= $form->field($model, 'charge')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'custom'
        ]) ?>
        <?= $form->field($model, 'contact_person')->textInput() ?>
        <?= $form->field($model, 'phone')->textInput() ?>
        <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
        <?= $form->field($model, 'sait')->textInput()->hint('Пример: sait.by') ?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right']); ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
