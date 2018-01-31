<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\jui\SliderInput;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search" id="filter">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true ],
    ]); ?>

    <?= $form->field($model, 'short_description')->input('text', ['placeholder' => "Введите текст для поиска"]) ?>

    <?= $form->field($model, 'category')->widget(Select2::classname(), [
        'data' => $category,
        'options' => ['placeholder' => 'Выберите категорию...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);  ?>

    <?= $form->field($model, 'status')->checkboxList([Product::STATUS_ACTIVE => 'Только активные'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Отобрать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', Url::to(['product/index']), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
