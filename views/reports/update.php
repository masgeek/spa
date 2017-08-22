<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_RESERVATIONS */

$this->title = 'Update My  Reservations: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'My  Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RESERVATION_ID, 'url' => ['view', 'id' => $model->RESERVATION_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="my--reservations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
