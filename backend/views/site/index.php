<?php

/* @var $this yii\web\View */

$this->title = 'Панель администрирования';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-aqua"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Услуги</span>
                    <span class="info-box-number"><?=\backend\models\RequestSearch::find()->count()?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-yellow"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Товары</span>
                    <span class="info-box-number"><?= \common\models\Product::find()->count()?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-user-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Вакансии</span>
                    <span class="info-box-number"><?= \common\models\Vacancy::find()->count() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Резюме</span>
                    <span class="info-box-number"><?= \common\models\Resume::find()->count() ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>

</div>
