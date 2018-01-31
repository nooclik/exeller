<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 09.08.2017
 * Time: 15:58
 */
use yii\widgets\Pjax;
use yii\widgets\ListView;


$this->title = 'Весь товар';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php Pjax::begin() ?>
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_filter', [
                'model' => $modelSearch,
                'category' => $category,
            ]) ?>
        </div>
        <div class="col-md-9 col-item-list">
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
            ]);
            ?>
        </div>
    </div>
<?php Pjax::end();