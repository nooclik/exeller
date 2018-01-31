<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 04.08.2017
 * Time: 11:11
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Пожаловаться';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <h3><?= $post_title ?></h3>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($data, 'motive')->textarea(['rows' => '6', 'placeholder' => 'Причина жалобы...']) ?>
        <?= $form->field($data, 'post_id')->textInput(['value' => $post_id, 'type' => 'hidden'])->label('') ?>
        <?= $form->field($data, 'user_id')->textInput(['value' => Yii::$app->user->identity->id, 'type' => 'hidden'])->label('') ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a(Отмена, ['service/request-list'], ['btn btn-link']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
