<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 18.08.2017
 * Time: 13:12
 */

use yii\helpers\Html;

$this->title = 'Просмотр вакансии ' . $this->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 request-view-title-row">
        <div class="col-md-10">
            <h2><?= $data->post ?> (<?= $category ?>)</h2>
        </div>
        <div class="col-md-2">
            <!--<span class="label-price"><?= $data->salary ?></span>-->
        </div>
    </div>
</div>
<div class="row request-view-data-row">
    <div class="col-md-9 request-product-view_detail">
        <p class="label-user"><strong><?= $user->nicename ?></strong></p>
        <p><strong>Желаемая зарплата: </strong><?= !empty($data['salary']) ? $data['salary'] . ' руб.' : 'Не указана' ?>
        </p>
        <p><strong>Стаж работы: </strong>
            <?= isset($data['experience']) ? (int)$data['experience'] : 'Не указан' ?>
        </p>
        <p><strong>Образование: </strong><?= !empty($data['education']) ? $data['education'] : 'Не указано' ?>
        </p>
        <?php if ($skills) : ?>
            <p><strong>Навыки: </strong><?= implode(', ', $skills) ?></p>
        <?php endif; ?>
        <p>
            <?php if ($data['city']) echo '<span class="label-adres"></span>' . $data['city'] ?>
        </p>
        <?php if ($institution['place_study']): ?>
            <p><strong>Учебное заведение: </strong><?= $institution['place_study'] ?></p>
            <p><strong>Факультет: </strong><?= $institution['faculty'] ?></p>
            <p><strong>Специализация: </strong><?= $institution['speciality'] ?></p>
            <p><strong>Год окончания: </strong><?= $institution['year'] ?></p>
        <?php endif; ?>
        <p><?php if ($data['age']) echo '<strong>Возраст: </strong>' . $data['age'] ?></p>
    </div>

    <div class="col-md-3">
        <?php if ($thumbnail): ?>
            <div id="thumbnail">
                <?= Html::img('@thumbnail/' . $thumbnail) ?>
            </div>
            <br>
        <?php endif; ?>
        <p class="label-publish-item">Размещено <?= date('d.m.Y в H:i', strtotime($data['publish'])) ?></p>
        <p class="label-status"><?= $data->status; ?></p>
        <?php if ($data->user_id == Yii::$app->user->identity->id): ?>
            <p class="label-edit"><?= Html::a('Редактировать', ['work/edit-resume', 'id' => $data->id]) ?></p>
            <?php if ($data->status == \common\models\Resume::STATUS_ACTIVE) : ?>
                <p class="label-close"><?= Html::a('Закрыть', ['work/view-resume', 'action' => 'close', 'id' => $data->id]) ?></p>
            <?php else : ?>
                <p class="label-inpublish"><?= Html::a('Открыть', ['work/view-resume', 'action' => 'activate', 'id' => $data->id]) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<div class="request-view-control-row row">
    <?= Html::a('К списку', ['work/resume-list'], ['class' => 'btn btn-info return']) ?>
    <?= Html::a('Пожаловаться', ['site/complaint', 'post_id' => $data->id], ['class' => 'btn btn-danger complain']) ?>
</div>
