<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 31.07.2017
 * Time: 22:28
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use common\models\Request;

$this->title = $data->short_description;
$this->params['breadcrumbs'][] = ['label' => 'Все заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="request-view-title-row row">
            <div class="request-view-title-col col-md-10">
                <h2><?= $data->short_description ?></h2>
            </div>
            <div class="col-md-2">
                <h2>
                    <span class="label-price"><?= $data->price ?></span>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="row request-view-data-row">
    <div class="col-md-9 request-view-detail">
        <div class="request-view_map">
            <?= yii2mod\google\maps\markers\GoogleMaps::widget([
                'userLocations' => [
                    [
                        'location' => [
                            'address' => $data['address'],
                            'city' => $data['city'],
                            'country' => 'Беларусь',
                        ],
                        'htmlContent' => $data['short_description'],
                    ],
                ],

                'googleMapsUrlOptions' => [
                    'key' => 'AIzaSyBmRoDhBBmIB9bpXi4DJsPUJX9mVpe415o',
                    'language' => 'ru',
                    'version' => '3.1.18',
                    'region' => 'ru',
                ],
                'googleMapsOptions' => [
                    'mapTypeId' => 'roadmap',
                    'tilt' => 45,
                    'zoom' => 35,
                ],

            ]); ?>
        </div>

        <p><span>Адрес: </span><?= $data->address . ', ' . $data->city ?></p>
        <!--<p><span>Начать: </span><?= date('d.m.Y', strtotime($data['date_to_date_before'])) ?></p>-->
        <p><span>Желаемое время: </span>c <?= date('H:i', strtotime($data->date_to_time_before)) ?>
            до <?= date('H:i', strtotime($data->date_to_time_after)) ?></p>
        <p><span>Стоимость: </span><?= $data->price ?>руб.</p>
        <p><span>Описание: </span><?= $data->description ?></p>
        <p><span>Метод оплаты: </span><?= $payment->name ?></p>
    </div>
    <?php if (Request::isDone($data['id'])): ?>
    <div class="col-md-3 request-complete">
        <?php else: ?>
        <div class="col-md-3">
            <?php endif; ?>
            <p class="label-date-after-item">Выполнить
                до <?= date('d.m.Y', strtotime($data['date_to_date_before'])) ?></p>
            <p class="label-publish-item">Размещено <?= date('d.m.Y в H:i', strtotime($data['publish'])) ?></p>
            <p class="label-publish-item">Обновлено <?= date('d.m.Y в H:i', strtotime($data['update'])) ?></p>

            <?php if ($data->status == Request::STATUS_CLOSE) : ?>
                <p class="label-status status-close"><?= $data->status; ?></p>
            <?php elseif ($data->status == Request::STATUS_SELECTED) : ?>
                <p class="label-status status-selected"><?= $data->status; ?></p>
            <?php else : ?>
                <p class="label-status"><?= $data->status; ?></p>
            <?php endif; ?>

            <?php if (!Yii::$app->user->isGuest) : ?>
                <?php if ($data->user_id == Yii::$app->user->identity->id): ?> <!-- ЕСЛИ ВЛАДЕЛЕЦ -->
                    <?php if ($data->status == Request::STATUS_SELECTED) : ?>
                        <p class="label-finish"><?= Html::a('Выполнено', ['close', 'request_id' => $data->id]) ?></p>
                        <p class="label-inpublish"><?= Html::a('Открыть', ['view', 'action' => 'publish', 'id' => $data->id]) ?></p>
                        <p class="label-edit"><?= Html::a('Редактировать', ['update', 'id' => $data->id]) ?></p>
                    <?php endif; ?>
                    <?php if ($data->status == Request::STATUS_CLOSE) : ?>
                        <p class="label-inpublish"><?= Html::a('Открыть', ['view', 'action' => 'publish', 'id' => $data->id]) ?></p>
                        <p class="label-edit"><?= Html::a('Редактировать', ['update', 'id' => $data->id]) ?></p>
                    <?php endif; ?>
                    <?php if ($data->status == Request::STATUS_ACTIVE): ?>
                        <p class="label-close"><?= Html::a('Закрыть', ['view', 'action' => 'close', 'id' => $data->id]) ?></p>
                        <p class="label-unpublish"> <?= Html::a('Снять с публикации', ['view', 'action' => 'unpublish', 'id' => $data->id]) ?></p>
                        <p class="label-edit"><?= Html::a('Редактировать', ['update', 'id' => $data->id]) ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <p><span id="time-left"></span></p>
            <?php if ($data['attachment']) : ?>
                <p><span>Изрображение: </span></p>
                <div id="thumbnail_request">
                    <?= Html::img('../web//uploads/thumbnail/' . $data['attachment']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row request-view-control-row">
        <?= Html::a('К заявкам', ['service/index'], ['class' => 'btn btn-info return']) ?>
        <?php if ($data->status == Request::STATUS_ACTIVE && !Request::isContractor(Yii::$app->user->identity->id, $data->id) && !Request::isCustomer(Yii::$app->user->identity->id, $data->id)) : ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => 'Отозваться',
                    'class' => 'btn btn-success'
                ]
            ]);
            $form = ActiveForm::begin();
            echo $form->field($deal, 'message')->textarea(['rows' => '6', 'placeholder' => 'Введите текст Вашего предложения...']);
            echo Html::submitButton('Отправить', ['class' => 'btn btn-success']);
            ActiveForm::end();
            Modal::end();
            ?>
        <?php endif; ?>
        <?= Html::a('Пожаловаться', ['site/complaint', 'post_id' => $data->id], ['class' => 'btn btn-danger complain']) ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="request_view-candidate_list"> <!-- ИСПОЛНИТЕЛИ -->
                <?php foreach ($candidates as $candidate) : ?>
                    <li>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="label-user"></span>
                                <?= Html::a(\common\models\User::findOne($candidate['contractor_id'])->nicename, ['user/user-info', 'user_id' => $candidate['contractor_id']]) ?>
                            </div>
                            <div class="col-md-6">
                                <?php if ($data->status !== Request::STATUS_SELECTED && $data->status !== Request::STATUS_CLOSE && $data->status !== Request::STATUS_DONE && Yii::$app->user->identity->id == $data->user_id) : ?>
                                    <?= Html::a('<span class="label-check"></span>Выбрать исполнителем', ['contractor' => $candidate['contractor_id'], 'id' => $data['id']], ['class' => 'btn btn-primary']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $candidate['message'] ?>
                                <div class="label-publish-item">
                                    <?= date('d.m.Y H:m', strtotime($candidate['publish'])) ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php
    $date_left = explode('-', $data['date_to_date_after']);
    $time_left = explode(':', $data['date_to_time_after']);
    //print_r($time_left); exit();
    ?>
    <script type="text/javascript">
        timeend = new Date();
        // IE и FF по разному отрабатывают getYear()
        timeend = new Date(<?= $date_left[0] ?>, <?= $date_left[1] ?> -1, <?= $date_left[2] ?>,  <?= $time_left[0] ?> -1,  <?= $time_left[1] ?>);
        // для задания обратного отсчета до определенной даты укажите дату в формате:
        // timeend= new Date(ГОД, МЕСЯЦ-1, ДЕНЬ);
        // Для задания даты с точностью до времени укажите дату в формате:
        // timeend= new Date(ГОД, МЕСЯЦ-1, ДЕНЬ, ЧАСЫ-1, МИНУТЫ);
        function time() {
            today = new Date();
            today = Math.floor((timeend - today) / 1000);
            tsec = today % 60;
            today = Math.floor(today / 60);
            if (tsec < 10) tsec = '0' + tsec;
            tmin = today % 60;
            today = Math.floor(today / 60);
            if (tmin < 10) tmin = '0' + tmin;
            thour = today % 24;
            today = Math.floor(today / 24);
            //timestr = "<span>" + today + "</span> д. <span>" + thour + "</span> ч. <span>" + tmin + "</span> мин. <span>" + tsec + "</span> сек.";
            timestr = "<span class=\'label-time-left\'>" + today + "</span> д. <span>" + thour + "</span> ч. <span>" + tmin + "</span> мин.";

            document.getElementById('time-left').innerHTML = timestr;

            window.setTimeout("time()", 1000);
        }
    </script>
    <?php if (date('Y-m-d') < $data['date_to_date_after'] && $data->status == Request::STATUS_ACTIVE): ?>
    <body onload="time()">
    <?php endif; ?>




