<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\model_extended\USERS_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users--model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SURNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OTHER_NAMES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOBILE_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCOUNT_STATUS')->textInput() ?>

    <?= $form->field($model, 'ACCOUNT_TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
