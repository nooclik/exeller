<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 03.08.2017
 * Time: 18:16
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use kartik\typeahead\Typeahead;

$this->title = 'Редактирование заявки';
$this->params['breadcrumbs'][] = ['label' => 'Все заявки', 'url' => ['request-list']];
$this->params['breadcrumbs'][] = $this->title;

$params = ['prompt' => 'Выберите категорию...', 'class' => 'input-lg form-control'];
?>


<?=
    $this->render('_form', compact('model', 'payment', 'category', 'city', 'personal'));
?>