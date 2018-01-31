<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 09.08.2017
 * Time: 16:14
 */
use yii\helpers\Html;

$this->title = 'Все заявки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 request-view-title-row">
        <div class="col-md-10">
            <h2><?= $data->short_description ?></h2>
        </div>
        <div class="col-md-2">
            <span class="label-price"><?= $data->price ?></span>
        </div>
    </div>
</div>
<div class="row request-view-data-row">
    <div class="col-md-9 request-product-view_detail">
        <p><span>Контактное лицо: </span><?= $user->nicename ?></p>
        <p><span>Контактный телефон: </span><?= $user->phone ?></p>
        <p><span>Описание: </span><?= $data->full_description ?></p>
    </div>
    <div class="col-md-3">
        <p class="label-publish-item">Размещено <?= date('d.m.Y в H:i', strtotime($data['publish'])) ?></p>
        <p class="label-status"><?= $data->status; ?></p>
        <?php if ($data->user_id == Yii::$app->user->identity->id): ?>
            <p class="label-edit"><?= Html::a('Редактировать', ['update', 'id' => $data->id]) ?></p>
            <?php if ($data->status == \common\models\Product::STATUS_ACTIVE) : ?>
                <p class="label-close"><?= Html::a('Закрыть', ['product/view', 'action' => 'close', 'id' => $data->id]) ?></p>
            <?php else : ?>
                <p class="label-inpublish"><?= Html::a('Открыть', ['product/view', 'action' => 'activate', 'id' => $data->id]) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<div class="request-view-control-row row">
    <?= Html::a('К списку', ['product/index'], ['class' => 'btn btn-info return']) ?>
    <?= Html::a('Пожаловаться', ['site/complaint', 'post_id' => $data->id], ['class' => 'btn btn-danger complain']) ?>
</div>
