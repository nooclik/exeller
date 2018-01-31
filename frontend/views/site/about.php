<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Progress;
use common\models\User;
use frontend\models\Rule;
use common\models\Mail;


$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <?php 
    	echo Progress::widget([
		    'percent' => 60,
		    'label' => 'Ход выполнения'
		]);

		//$user = User::findOne(\Yii::$app->user->identity->id);

    $hash = Yii::$app->getSecurity()->generatePasswordHash('123456');

    $password = '123456';

    /*if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
        echo 'всё правильно';
    } else {
        echo 'неправильный пароль!';
    }*/

    //$userRole = Yii::$app->authManager->getRole('customer');
    //Yii::$app->authManager->assign($userRole, Yii::$app->user->identity->id);



        //$rule = Rule::find()->select('item_name')->where(['user_id' => Yii::$app->user->identity->id])->one();
        //print_r($rule->item_name);

       /* Yii::$app->authManager->revoke(Yii::$app->authManager->getRole($rule->item_name), Yii::$app->user->identity->id);
        $userRole = Yii::$app->authManager->getRole('customer');
        Yii::$app->authManager->assign($userRole, Yii::$app->user->identity->id);*/

        $mail = new Mail();
        $mail->send();
     ?>


</div>
