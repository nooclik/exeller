<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 22.01.2018
 * Time: 12:19
 */
use yii\helpers\Html;

?>
<ul class="request-product_list">
    <li>
        <div class="product-row-title row">
            <div class="col-title col-md-10"><?= Html::a($model->short_description, ['product/view', 'id' => $model->id]) ?></div>
            <div class="col-price col-md-2"><span class="label-price"><?= $model->price ?>
                    руб.</span></div>
        </div>
        <div class="product-row-data row">
            <div class="col-md-6 col-user">
                <span class="label-publish"><?= date('d.m.Y', strtotime($model->publish)) ?></span><br>
                <span class="label-category"><?= $model->categorys->name ?></span>
            </div>
            <div class="col-md-6 col-adres">
                <span class="label-status"><?= $model->status ?></span>
            </div>

        </div>
    </li>
</ul>