<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 10.08.2017
 * Time: 11:41
 */

use yii\helpers\Html;
Use yii\bootstrap\ActiveForm;

$this->title = 'Редактировать ';
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
    $this->render ('_form', compact('model', 'delivery', 'condition', 'category'));
?>

