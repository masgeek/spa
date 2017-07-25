<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */

$userid = Yii::$app->user->identity->id;

$salon_items = \app\model_extended\MY_SALONS::SalonDropdown($userid);
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'SALON_ID')->textInput() ?-->
    <?= $form->field($model, 'SALON_ID')->dropDownList($salon_items, ['prompt' => '--- SELECT SALON TO ASSIGN STAFF TO ---']) ?>

    <?= $form->field($model, 'STAFF_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STAFF_TEL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Staff' : 'Update', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
