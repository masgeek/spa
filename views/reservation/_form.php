<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_RESERVATIONS */
/* @var $form yii\widgets\ActiveForm */
$model->USER_NAME = $model->uSER->SURNAME;
?>

<div class="reservations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USER_ID')->hiddenInput() ?>

    <?= $form->field($model, 'USER_NAME')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'RESERVATION_DATE')->textInput() ?>

    <?= $form->field($model, 'TOTAL_COST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS_ID')->dropDownList(\app\model_extended\STATUS_MODEL::GetStatus(), ['prompt' => '--- SELECT STATUS --']) ?>

    <?= $form->field($model, 'ACCOUNT_REF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BOOKING_AMOUNT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
