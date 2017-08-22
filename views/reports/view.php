<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_RESERVATIONS */

$this->title = $model->RESERVATION_ID;
$this->params['breadcrumbs'][] = ['label' => 'My  Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my--reservations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->RESERVATION_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RESERVATION_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'RESERVATION_ID',
            'USER_ID',
            'RESERVATION_DATE',
            'TOTAL_COST',
            'STATUS_ID',
            'ACCOUNT_REF',
            'BOOKING_AMOUNT',
        ],
    ]) ?>

</div>
