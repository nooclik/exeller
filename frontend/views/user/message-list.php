<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 14.10.2017
 * Time: 10:46
 */
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <th>Отправитель</th>
            <th>Сообщение</th>
            <th>Получено</th>
            </thead>
            <?php foreach ($mesages as $mesage): ?>
                <tr>
                    <td><?= Html::a($mesage->userName->nicename, ['user-info', 'user_id' => $mesage->user_id_from]) ?></td>
                    <td>
                        <?php
                        Modal::begin([
                            'header' => '<strong>'.$mesage->userName->nicename.'</strong>',
                            'toggleButton' => [
                                'label' => '',
                                'class' => 'btn btn-link label-message-mail',
                            ],
                        ]);
                        echo $mesage->text;
                        Modal::end();
                        ?>
                    </td>
                    <td><?= Yii::$app->formatter->asDate($mesage->publish, 'm.d.Y H:i') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Назад', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
    </div>
</div>
