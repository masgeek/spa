<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_SERVICES */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="my--services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SERVICE_ID')->textInput() ?>

    <?= $form->field($model, 'SALON_ID')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'SERVICE_COST')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
