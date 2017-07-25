<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-md-8 col-md-offset-2" style="margin-top: 50px;">
    <div class="col-md-12 text-center"><h2>Login</h2></div>
    <div class="col-md-12 text-center">
        <h4>You need to login in order to proceed</h4>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        //'layout' => 'horizontal',
    ]); ?>

    <div class="row">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false)->hint('Username/Email') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'password')->passwordInput()->label(false)->hint('Password') ?>
    </div>
    <div class="row">
        <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-lg btn-block', 'name' => 'login-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
