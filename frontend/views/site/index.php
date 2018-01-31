<?php

/* @var $this yii\web\View */

$this->title = 'Моя приложуха';
?>
<div class="site-index">
    <div class="container-fluid head">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('home-page-body') ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('home-page-footer') ?>
            </div>
        </div>
    </div>
</div>
