<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reservations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'RESERVATION_ID',
            'USER_ID',
            'RESERVATION_DATE',
            'TOTAL_COST',
            'STATUS_ID',
            // 'ACCOUNT_REF',
            // 'BOOKING_AMOUNT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
