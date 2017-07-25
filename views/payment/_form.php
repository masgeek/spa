<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RESERVATION_ID')->textInput() ?>

    <?= $form->field($model, 'BOOKING_AMOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FINAL_AMOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_PAID')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_REF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FINALIZED')->textInput() ?>

    <?= $form->field($model, 'BALANCE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
