<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 20.11.2017
 * Time: 10:02
 */

$this->title = 'Создание маршрута';
$this->params['breadcrumbs'][] = ['label' => 'Все заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Новый маршрут';
?>

<?=
    $this->render('_form', compact('model', 'city', 'modelPoints'));
?>