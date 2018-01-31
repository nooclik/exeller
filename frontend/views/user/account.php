<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 28.08.2017
 * Time: 11:26
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;
use yii\bootstrap\Collapse;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-9">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <h3>Загрузите вашу фотографию</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="file-upload">
                    <?= $form->field($model, 'foto')->fileInput(['class' => 'btn btn-info'])->label('Выберите файл') ?>
                </div>
            </div>
        </div>

        <h3>Персональные данные</h3>
        <?= $form->field($model, 'username') ?>
        <div class="row form-inline">
            <div class="col-md-12">
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'surname') ?>
            </div>
        </div>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'phone')->input('tel') ?>
        <div class="row form-inline">
            <div class="col-md-12">
                <p><b>Дата рождения</b></p>
                <?= $form->field($model, 'day')->dropDownList($day_list, ['prompt' => 'День'])->label(false) ?>
                <?= $form->field($model, 'month')->dropDownList($month_list, ['prompt' => 'Месяц'])->label(false) ?>
                <?= $form->field($model, 'year')->dropDownList($year_list, ['prompt' => 'Год'])->label(false) ?>
            </div>
        </div>
        <?= $form->field($model, 'sex')->radioList($sex); ?>

        <h3>Местоположение</h3>
        <?= $form->field($model, 'region')->dropDownList($region) ?>
        <?= $form->field($model, 'city')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => ['highlight' => true],
            'dataset' => [['local' => $city,]]]) ?>
        <?= $form->field($model, 'street')->textInput() ?>
        <h3>Деятельность</h3>
        <?= $form->field($model, 'organization_form')->radioList($organization_form)->label(false); ?>
        <?= $form->field($model, 'category')->dropDownList($section) ?>
        <?= $form->field($model, 'notice')->checkboxList($notice)->label('Рубрики по которым желаете получать уведомления') ?>

        <!--<?= Collapse::widget([
            'items' => [
                [
                    'label' => 'Местоположение',
                    'content' => [$form->field($model, 'region')->dropDownList($region),
                        $form->field($model, 'city')->widget(Typeahead::classname(), [
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => ['highlight' => true],
                            'dataset' => [['local' => $city,]]])]
                    ,
                ],
                [
                    'label' => 'Деятельность',
                    'content' => 'content',
                ]
            ]
        ]);
        ?>-->

        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['data-confirm' => 'Вы уверены?', 'class' => 'btn btn-link']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-md-3">
        <?php if ($personal_data['thumbnail']) : ?>
            <div id="thumbnail">
                <?= Html::img('@thumbnail/' . $personal_data['thumbnail']) ?>
            </div>
        <?php endif; ?>
        <div id="account-my_list">
            <ul>
                <?php if (\common\models\Request::hasRequest(Yii::$app->user->identity->id)): ?>
                    <li><?= Html::a('<i class="glyphicon glyphicon-briefcase"> </i>Мои заявки', ['/user/my-list', 'id' => Yii::$app->user->identity->id, 'type' => 'service'], ['class' => 'btn btn-warning']); ?></li>
                <?php endif; ?>
                <?php if (\common\models\Product::hasProduct(Yii::$app->user->identity->id)): ?>
                    <li><?= Html::a('<i class="glyphicon glyphicon-shopping-cart"> </i>Мои товары', ['/user/my-list', 'id' => Yii::$app->user->identity->id, 'type' => 'product'], ['class' => 'btn btn-warning']) ?></li>
                <?php endif; ?>
                <?php if (\common\models\Resume::hasResume(Yii::$app->user->identity->id)): ?>
                    <li><?= Html::a('<i class="glyphicon glyphicon-file"> </i>Мое резюме', ['/user/my-list', 'id' => Yii::$app->user->identity->id, 'type' => 'resume'], ['class' => 'btn btn-warning']) ?></li>
                <?php endif; ?>
                <?php if (\common\models\Vacancy::hasVacancy(Yii::$app->user->identity->id)): ?>
                    <li><?= Html::a('<i class="glyphicon glyphicon-list-alt"> </i>Мои вакансии', ['/user/my-list', 'id' => Yii::$app->user->identity->id, 'type' => 'vacancy'], ['class' => 'btn btn-warning']) ?></li>
                <?php endif; ?>
                <?php if (\common\models\Message::hasMessage(Yii::$app->user->identity->id)): ?>
                    <li><?= Html::a('<i class="glyphicon glyphicon-envelope"> </i>Мои сообщения', ['message-list', 'user_id' => Yii::$app->user->identity->id, 'type' => 'vacancy'], ['class' => 'btn btn-warning']) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>



