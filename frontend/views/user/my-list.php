<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 11.09.2017
 * Time: 11:02
 */

use yii\helpers\Html;
use yii\widgets\Pjax;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin() ?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Назад', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
        <div class="table-responsive">
            <table class="table table-hover" width="100%">
                <thead>
                <?php foreach ($thead as $title): ?>
                    <th><?= $title ?></th>
                <?php endforeach; ?>
                </thead>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <?php foreach ($columns as $column) : ?>
                            <td><?= $item[$column] ?></td>
                        <?php endforeach; ?>
                        <td>
                            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', [$link_edit, 'id' => $item->id]) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [$link_view, 'id' => $item->id]) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/user/my-list', 'id' => $id, 'delete' => $item->id, 'type' => $type], ['data-confirm' => 'Вы уверены?']) ?></td>

                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php Pjax::end() ?>
