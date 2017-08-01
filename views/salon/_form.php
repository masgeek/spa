<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SALON_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALON_TEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALON_LOCATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALON_EMAIL')->textInput(['maxlength' => true,'type'=>'email']) ?>

    <?= $form->field($model, 'SALON_WEBSITE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALON_IMAGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'OWNER_ID')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
