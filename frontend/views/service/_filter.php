<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\jui\SliderInput;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="request-search" id="filter">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['data-pjax' => true],
        ]); ?>


        <?= $form->field($model, 'city')->widget(Select2::classname(), [
            'data' => $city,
            'options' => ['placeholder' => 'Выберите город...', 'id' => 's_city'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'category')->widget(Select2::classname(), [
            'data' => $category,
            'options' => ['placeholder' => 'Выберите категорию...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?php

        ?>

        <?= $form->field($model, 'price')->input('number', ['placeholder' => $minPrice, 'min' => $minPrice])->label('Цена от'); ?>

        <?= $form->field($model, 'status')->checkboxList(['Активна' => 'Только активные'])->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton('Отобрать', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сбросить', Url::to(['service/index']), ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php

