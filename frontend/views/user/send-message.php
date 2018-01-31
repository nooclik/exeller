<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 16.09.2017
 * Time: 15:18
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

$this->title = 'Новое сообщение';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($model, 'text')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'custom'
        ]) ?>
        <div class="file-upload">
            <?= $form->field($model, 'attachment')->fileInput(['class' => 'btn btn-primary'])->label('Выберите файл') ?>
        </div>
        <br>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn btn-warning', 'data-toggle' => 'tooltip', 'title' => 'dsds', 'data-placement' => 'right']); ?>
        <?php $form::end() ?>
    </div>
</div>
