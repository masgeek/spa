<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models_search\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="my--reservations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RESERVATION_ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'RESERVATION_DATE') ?>

    <?= $form->field($model, 'TOTAL_COST') ?>

    <?= $form->field($model, 'STATUS_ID') ?>

    <?php // echo $form->field($model, 'ACCOUNT_REF') ?>

    <?php // echo $form->field($model, 'BOOKING_AMOUNT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
