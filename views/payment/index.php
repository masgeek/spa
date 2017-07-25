<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PAYMENT_ID',
            'RESERVATION_ID',
            'BOOKING_AMOUNT',
            'FINAL_AMOUNT',
            'DATE_PAID',
            // 'PAYMENT_REF',
            // 'FINALIZED',
            // 'BALANCE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
