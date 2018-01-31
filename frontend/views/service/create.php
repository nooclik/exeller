<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 18.10.2017
 * Time: 23:20
 */

$this->title = 'Новая заявка';
$this->params['breadcrumbs'][] = ['label' => 'Все заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
    $this->render('_form', compact('model', 'payment', 'category', 'city', 'personal'))
?>
