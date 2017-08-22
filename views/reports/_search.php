<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models_search\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="my-reservations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['all-reservations'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'RESERVATION_DATE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
