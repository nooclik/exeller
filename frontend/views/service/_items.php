<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 19.01.2018
 * Time: 20:17
 */
use yii\helpers\Html;
use common\models\Request;

?>

<div class="row" id="service">
    <div class="col-md-12">

        <ul class="request-list_task-list">
            <li>
                <div class="request-list_task">
                    <div class="task-row-title row">
                        <div class="col-title col-md-10"><?= Html::a($model->short_description, ['view', 'id' => $model->id]) ?></div>
                        <div class="col-price col-md-2"><span class="label-price"><?= $model->price ?>
                                руб.</span></div>
                    </div>
                    <div class="task-row-data row">
                        <div class="col-md-6 col-user">
                            <span class="label-publish"><?= date('d.m.Y', strtotime($model->publish)) ?></span><br>
                            <span class="label-category"><?= \common\models\CategoryService::findOne($model->category)->name ?></span><br>

                            <?php if ($model->status == Request::STATUS_CLOSE): ?>
                                <span class="status-close"><?= $model->status ?></span>
                            <?php elseif ($model->status == Request::STATUS_SELECTED) : ?>
                                <span class="status-selected"><?= $model->status ?></span>
                            <?php elseif ($model->status == Request::STATUS_ACTIVE): ?>
                                <span class="status-active"><?= $model->status ?></span>
                            <?php elseif ($model->status == Request::STATUS_DONE): ?>
                                <span class="status-finish"><?= $model->status ?></span>
                            <?php else: ?>
                                <span><?= $model->status ?></span>
                            <?php endif ?>
                        </div>
                        <div class="col-md-6 col-adres">
                            <?php if (date('Y-m-d') < $model->date_to_date_before) : ?>
                                <p class="label-date-after">
                                    До <?= date('d.m.Y', strtotime($model->date_to_date_before)) ?></p>
                            <?php else : ?>
                                <p class="label-expired">Просрочена</p>
                            <?php endif; ?>

                            <span class="label-adres"><?= trim($model->address) ?>,
                                <?= trim($model->city) ?></span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
