<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\model_extended\RESERVED_SERVICES */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserved--services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'OFFERED_SERVICE_ID')->textInput() ?>

    <?= $form->field($model, 'STAFF_ID')->textInput() ?>

    <?= $form->field($model, 'RESERVATION_ID')->textInput() ?>

    <?= $form->field($model, 'RESERVATION_DATE')->textInput() ?>

    <?= $form->field($model, 'RESERVATION_TIME')->textInput() ?>

    <?= $form->field($model, 'SERVICE_AMOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
