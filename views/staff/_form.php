<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STAFF_ID')->textInput() ?>

    <?= $form->field($model, 'SALON_ID')->textInput() ?>

    <?= $form->field($model, 'STAFF_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STAFF_TEL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
