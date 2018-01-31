<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 18.10.2017
 * Time: 23:41
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$params = ['prompt' => 'Выберите категорию...'];
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'category')->dropDownList($category, $params); ?>
        <?= $form->field($model, 'short_description')->textInput()->hint('Например: Ноутбук Lenovo') ?>
        <?= $form->field($model, 'full_description')->textarea(['rows' => 6])->hint('Описание товара, его характеристики') ?>
        <?= $form->field($model, 'condition')->radioList($condition); ?>
        <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => '0', 'placeholder' => 0, 'step' => '0.5'])->hint('Порог цены за товар') ?>
        <?= $form->field($model, 'delivery_id')->radioList($delivery, ['1']) ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Отмена', ['site/index'], ['data-confirm' => 'Вы уверены?', 'class' => 'btn', 'data-placement' => 'right']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>