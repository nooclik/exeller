<?php
/* @var $this yii\web\View */
//http://demos.krajee.com/widget-details/datepicker#usage

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use kartik\date\DatePicker;
use kartik\typeahead\Typeahead;
use kartik\time\TimePicker;

?>
<?php $params = ['prompt' => 'Выберите категорию...', 'class' => 'form-control']; ?>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'category')->dropDownList($category, $params); ?>
                <?= $form->field($model, 'user_id')->textInput(['value' => User::findOne(Yii::$app->user->identity->id)->id, 'type' => 'hidden'])->label(false) ?>
                <?= $form->field($model, 'short_description')->textInput(['placeholder' => 'Введите заголовок для заявки']) ?>
                <?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>
            </div>
        </div>
        <div class="row">
            <div class='col-md-12'>
                <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to_date_before',
                    //'attribute2' => 'date_to_date_after',
                    'options' => ['placeholder' => 'Дата выполнения'],
                    //'options2' => ['placeholder' => 'Дата окончания'],
                    //'type' => DatePicker::TYPE_RANGE,
                    //'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
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
            <div class="col-xs-12 col-md-2">
                <label>Время с:</label>
                <?= TimePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to_time_before',
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                        'minuteStep' => 1,
                        'secondStep' => 5,
                    ]
                ]);
                ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label>Время по:</label>
                <?= TimePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_to_time_after',
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                        'minuteStep' => 1,
                        'secondStep' => 5,
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
                    'options' => ['placeholder' => 'Введите Ваш город'],
                    'pluginOptions' => ['highlight' => true],
                    'dataset' => [['local' => $city,]]]) ?>
                <!--<?= $form->field($model, 'customer_info') ?>-->
                <?= $form->field($model, 'address')->textInput(['placeholder' => 'Введите Ваш фактический адрес', 'value' => $personal["street"]])->hint('Пример: Советская, 100') ?>
            </div>
        </div>
        <div class="row form-inline">
            <div class="col-md-12">
                <?= $form->field($model, 'payment_id')->radioList($payment, ['2']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => '0']) ?>
                <?= $form->field($model, 'publish')->textInput(['value' => date('Y-m-d H:i:s'), 'type' => 'hidden'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <div class="file-upload">
                    <?= $form->field($model, 'thumnail')->fileInput(['class' => 'btn btn-primary'])->label(true) ?>
                </div>
            </div>
        </div>
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right']); ?>
            </div>
        </div>
        <div class="row visible-xs">
            <div class="col-xs-6">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'style' => 'width: 100%;']) ?>
            </div>
            <div class="col-xs-6">
                <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn btn-info', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right', 'style' => 'width: 100%;']); ?>
            </div>
        </div>

        <?= $form->field($dModel, 'name1') ?>

        <?php ActiveForm::end(); ?>
    </div>



    <div class="dop">

        <?php $form2 = ActiveForm::begin()?>
            <?php foreach ($dModel as $key) : ?>

            <?php endforeach; ?>
        <?php ActiveForm::end(); ?>
    </div>


</div>