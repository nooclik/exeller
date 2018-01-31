<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 04.08.2017
 * Time: 13:51
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Закрыть заявку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <p><strong>Закрытие заявки: </strong><?= $data->short_description ?></p>
        <p><strong>Исполнитель: </strong><?= $contractor->nicename ?></p>

        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'rewiew')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'rating')->textInput(['type' => 'hidden'])->label(false) ?>

        <p>Скорость выполнения</p>
        <input name="speed" type="radio" value="1" onchange="ChangeRaiting()"> 1
        <input name="speed" type="radio" value="2" onchange="ChangeRaiting()"> 2
        <input name="speed" type="radio" value="3" onchange="ChangeRaiting()"> 3
        <input name="speed" type="radio" value="4" onchange="ChangeRaiting()"> 4
        <input name="speed" type="radio" value="5" onchange="ChangeRaiting()"> 5

        <p>Качество выполнения</p>
        <input name="quality" type="radio" value="1" onchange="ChangeRaiting()"> 1
        <input name="quality" type="radio" value="2" onchange="ChangeRaiting()"> 2
        <input name="quality" type="radio" value="3" onchange="ChangeRaiting()"> 3
        <input name="quality" type="radio" value="4" onchange="ChangeRaiting()"> 4
        <input name="quality" type="radio" value="5" onchange="ChangeRaiting()"> 5

        <p>Вежливость</p>
        <input name="comity" type="radio" value="1" onchange="ChangeRaiting()"> 1
        <input name="comity" type="radio" value="2" onchange="ChangeRaiting()"> 2
        <input name="comity" type="radio" value="3" onchange="ChangeRaiting()"> 3
        <input name="comity" type="radio" value="4" onchange="ChangeRaiting()"> 4
        <input name="comity" type="radio" value="5" onchange="ChangeRaiting()"> 5
        <p><br>
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right']); ?>
        </p>
        <?php ActiveForm::end() ?>
    </div>
</div>

<script>
    function ChangeRaiting() {
        $('#review-rating').val(CalculateRating());
    }

    function CalculateRating() {
        var speed = 0;
        var quality = 0;
        var comity = 0;

        if ($('[name="speed"]:checked').val() != null) speed = $('[name="speed"]:checked').val();
        if ($('[name="quality"]:checked').val() != null) quality = $('[name="quality"]:checked').val();
        if ($('[name="comity"]:checked').val() != null) comity = $('[name="comity"]:checked').val();

        var rating = (parseInt(speed) + parseInt(quality) + parseInt(comity)) / 3;
        return Math.round(rating);
    }
</script>