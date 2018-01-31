<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 09.08.2017
 * Time: 14:32
 */

$this->title = 'Заявка на товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?=
    $this->render('_form', compact('model', 'delivery', 'condition', 'category'));
?>

