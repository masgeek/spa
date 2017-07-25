<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */

$this->title = $model->PAYMENT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PAYMENT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PAYMENT_ID], [
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
            'PAYMENT_ID',
            'RESERVATION_ID',
            'BOOKING_AMOUNT',
            'FINAL_AMOUNT',
            'DATE_PAID',
            'PAYMENT_REF',
            'FINALIZED',
            'BALANCE',
        ],
    ]) ?>

</div>
