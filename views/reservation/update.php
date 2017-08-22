<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Process Reservations: ' . $model->RESERVATION_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['/my-bookings']];
//$this->params['breadcrumbs'][] = ['label' => $model->RESERVATION_ID, 'url' => ['view', 'id' => $model->RESERVATION_ID]];
$this->params['breadcrumbs'][] = 'Process';
?>
<div class="reservations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
