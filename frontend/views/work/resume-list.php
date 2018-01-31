<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 18.08.2017
 * Time: 13:12
 */
use yii\widgets\Pjax;
use yii\helpers\Html;
use common\models\CategoryWork;
use yii\widgets\ListView;

$this->title = 'Список кандидатов';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="row">
    <?php Pjax::begin() ?>
    <div class="col-md-3">
        <?= $this->render('_filter-resume', [
            'model' => $searchModel,
            'category' => $category,
            'city' => $city,
            'education' => $education,
            'sex' => $sex,
            'minAge' => $minAge,
            'minExperience' => $minExperience,
        ]); ?>
    </div>
    <div class="col-md-9 col-item-list">
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item-resume',
            'layout' => "{pager}\n{items}\n{pager}",
        ]);
        ?>
    </div>
    <?php Pjax::end() ?>
</div>
