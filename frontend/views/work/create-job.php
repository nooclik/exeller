<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 13.08.2017
 * Time: 14:31
 *
 * http://mini.s-shot.ru/1024/400/png/?http://www.site.ru'
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\typeahead\TypeaheadBasic;
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
        <?= $form->field($model, 'phone')->textInput(['id' => 'phone', 'placeholder' => '(xx) xxx-xx-xx']) ?>
        <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
        <?= $form->field($model, 'sait')->textInput()->hint('Пример: sait.by') ?>

        <?= Html::submitButton('Создать', ['class' => 'btn btn-success btn-lg']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
<?php
$this->registerJS ("
    $('#phone').mask('(00) 000-00-00');
");