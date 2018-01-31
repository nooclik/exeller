<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 17.08.2017
 * Time: 13:24
 */

use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'Список вакансий';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <?php Pjax::begin() ?>
    <div class="col-md-3">
        <?= $this->render('_filter-vacancy', [
            'model' => $modelSearch,
            'category' => $category,
            'city' => $city,
            'minPrice' => $minPrice,
            'post' => $post,
        ]) ?>
    </div>
    <div class="col-md-9 col-item-list">
        <?=
            ListView::widget([
                    'dataProvider' => $dataProvider,
                'itemView' => '_item-job'
            ]);
        ?>
    </div>
    <?php Pjax::end() ?>
</div>

