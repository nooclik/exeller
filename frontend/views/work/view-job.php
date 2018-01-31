<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 17.08.2017
 * Time: 15:13
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Просмотр вакансии ' . $this->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 request-view-title-row">
        <div class="col-md-10">
            <h2><?= $data->post ?></h2>
        </div>
        <div class="col-md-2">
            <span class="label-price"><?= $data->price ?></span>
        </div>
    </div>
</div>
<div class="row request-view-data-row">
    <div class="col-md-9 request-product-view_detail">
        <h4><?= $detail['type'] . ' ' . $data['name'] ?></h4>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Уровень зарплаты</strong></p>
                <?= !empty($data['price']) ? (int)$data['price'] . ' руб.' : 'Договорная'; ?>
            </div>
            <div class="col-md-4">
                <p><strong>Город</strong></p>
                <?= $data['city'] ?>
            </div>
            <div class="col-md-4">
                <p><strong>Требуемый опыт работы</strong></p>
                <?= !empty($data['experience']) ? (int)$data['experience'] : 'Не требуется'; ?>
            </div>
        </div>
        <div class="request-work_row-detail"></div>
        <?php if (!empty($detail['description'])): ?>
            <strong>Условия</strong>
            <p>
                <?= $detail['description'] ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($detail['charge'])): ?>
            <strong>Обязанности</strong>
            <p>
                <?= Html::encode($detail['charge']) ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($detail['contact_person'])): ?>
            <strong>Контактное лицо</strong>
            <p>
                <?= $detail['contact_person'] ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($detail['phone'])): ?>
            <p><span class="label-phone"></span>
                <?= Html::encode($detail['phone']) ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($detail['email'])): ?>
            <p><span class="label-email"></span>
                <?= Html::encode($detail['email']) ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($detail['sait'])): ?>
            <p>
                <?= Html::a(Html::encode($detail['sait']), Url::to(Html::encode($detail['sait']))) ?>
            </p>
        <?php endif; ?>

    </div>
    <div class="col-md-3">
        <p class="label-publish-item">Размещено <?= date('d.m.Y в H:i', strtotime($data['publish'])) ?></p>
        <p class="label-status"><?= $data->status; ?></p>
        <?php if ($data->user_id == Yii::$app->user->identity->id): ?>
            <p class="label-edit"><?= Html::a('Редактировать', ['work/edit-job', 'id' => $data->id]) ?></p>
            <?php if ($data->status == \common\models\Vacancy::STATUS_ACTIVE) : ?>
                <p class="label-close"><?= Html::a('Закрыть', ['work/view-job', 'action' => 'close', 'id' => $data->id]) ?></p>
            <?php else: ?>
                <p class="label-inpublish"><?= Html::a('Открыть', ['work/view-job', 'action' => 'activate', 'id' => $data->id]) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<div class="request-view-control-row row">
    <?= Html::a('К списку', ['work/job-list'], ['class' => 'btn btn-info return']) ?>
    <?= Html::a('Пожаловаться', ['site/complaint', 'post_id' => $data->id], ['class' => 'btn btn-danger complain']) ?>
</div>
