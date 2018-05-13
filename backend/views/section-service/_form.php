<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SectionService */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="section-service-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'disabled')->dropDownList([0 => 'Отображать', 1 => 'Скрывать']) ?>

    <span id="add_fields" class="btn">Добавить</span>
    <div id="fields"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class' => 'btn btn-link']) ?>
    </div>

<?php ActiveForm::end(); ?>
    <div class='row'></div>
<?php
$name = "<div class='row'><div class='col-md-4'><input type='text' placeholder='Имя атрибута' id='sectionservice-attr_name' class='form-control' name='SectionService[attr_name][]'></div>";
$type = "<div class='col-md-4'><select id='sectionservice-attr_type' class='form-control' name='SectionService[attr_type][]'><option value='string'>Строка</option><option value='integer'>Число</option></select></div>";
$label = "<div class='col-md-4'><input type='text' placeholder='Метка атрибута' id='sectionservice-attr_label' class='form-control' name='SectionService[attr_label][]'></div></div>";

$this->registerJs('
    $("#add_fields").on("click", function(){
        $("#fields").append("' . $name . $type . $label . '");

    });
');
