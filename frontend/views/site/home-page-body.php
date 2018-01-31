<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 30.10.2017
 * Time: 12:09
 */
use common\models\CategoryService;
use common\models\SectionService;

$sections = SectionService::find()->select('id, name')->orderBy('name')->all();
?>

<div class="row" id="home-page_body">
    <div class="col-md-12">
        <ul class="home-page_category">
            <?php foreach ($sections as $section) : ?>
                <li>
                    <h3><?= $section['name'] ?></h3>
                    <!--<?php $categorys = CategoryService::find()->select('name')->where(['section_id' => $section['id']])->all(); ?>
                    <ul>
                        <?php foreach ($categorys as $category) : ?>
                            <li><?= $category['name'] ?></li>
                        <?php endforeach; ?>
                    </ul>-->
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
