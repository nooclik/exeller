<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 15.09.2017
 * Time: 16:38
 */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
            <h2><?= $user['nicename'] ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div id="thumbnail">
                <?= $personal_data['thumbnail'] ? Html::img('../web//uploads/thumbnail/' . $personal_data['thumbnail']) : Html::img('../web//uploads/thumbnail/no-foto.png') ?>
            </div>
        </div>
        <div class="col-md-10">
            <p>Город: <?= $user['city'] ?></p>
            <p>Возраст: <?= $age ?></p>
            <p>Выполнено заданий: <?= count($reviews) ?></p>
            <p>Средняя оценка: <?= round($rating) ?></p>
            <p><?= Html::a('<span class="label-email">Написать</span>', ['send-message', 'user_from' => Yii::$app->user->id, 'user_to' => $user->id], ['class' => 'btn btn-primary']) ?></p>
        </div>
    </div>
<?php if ($typesOfWork): ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Виды выполняемых работ</h4>

            <ul>
                <?php foreach ($typesOfWork as $type) : ?>
                    <li><?= $type['category'] ?></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
<?php endif; ?>
<?php if ($reviews): ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Отзывы</h4>
            <ul id='user-user-info_review'>
                <?php foreach ($reviews as $review) : ?>
                    <li>
                        <div>
                            <strong><?= $review['nicename'] ?></strong>
                            <p class="label-publish-item">
                                Отметка: <?= $review['rating'] ?>
                                <?= $review['rating'] >= 3 ? '<span class="label-like"></span>' : '<span class="label-nolike"></span>' ?>
                            </p>
                        </div>
                        <div class="user_review">
                            <div class="user_review-title">
                            <span class="label-publish-item">Отзыв о выполнении задания «<?= Html::a($review['short_description'], ['service/request-view', 'id' => $review['request_id']]) ?>
                                »</span>
                            </div>
                            <div class="user_review-text">
                                <?= trim($review['rewiew']) ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
