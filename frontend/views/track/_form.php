<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 20.11.2017
 * Time: 10:02
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\typeahead\Typeahead;
use kartik\date\DatePicker;
use dosamigos\ckeditor\CKEditor;
//use wbraganca\dynamicform\DynamicFormWidget;

?>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin() ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'start')->widget(Typeahead::classname(), [
                        'options' => ['placeholder' => 'Введите город отправление'],
                        'pluginOptions' => ['highlight' => true],
                        'dataset' => [['local' => $city,]]]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'finish')->widget(Typeahead::classname(), [
                        'options' => ['placeholder' => 'Введите город назначения'],
                        'pluginOptions' => ['highlight' => true],
                        'dataset' => [['local' => $city,]]]) ?>
                </div>
            </div>

            <div class="row">
                <div class='col-md-12'>
                    <?= DatePicker::widget([
                        'model' => $model,
                        'attribute' => 'date_start',
                        'options' => ['placeholder' => 'Дата отправления'],
                        'form' => $form,
                        'pluginOptions' => [
                            'format' => 'dd.mm.yyyy',
                            'todayBtn' => true,
                            'autoclose' => true,
                        ]
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
                        'options' => ['rows' => 6],
                        'preset' => 'basic'
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'action')->checkboxList(['Пассажир' => 'Пассажир', 'Посылка' => 'Посылка']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span id='addPoint' class="label_add">ADD</span>
                    <div id="point">
                    </div>
                </div>
            </div>
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php

$js = <<< JS
$(document).ready(function() {
  $('#addPoint').click(function(){
    $('<div class="row form-group">' +
     '<div class="col-md-9">' +
     '<input type="text" class="form-control" data name="points[]">' +
     '</div>' +
        '<div class="col-md-3">' +
            '<span class="deletePoint label-delete"></span>' + 
        '</div>' +
     '/div')
     .fadeIn('slow').appendTo('#point');
});
})

JS;

$this->registerJS($js, \yii\web\View::POS_END);