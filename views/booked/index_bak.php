<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reserved  Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserved--services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reserved  Services', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'RESERVED_SERVICE_ID',
            'OFFERED_SERVICE_ID',
            'STAFF_ID',
            'RESERVATION_ID',
            'RESERVATION_DATE',
            // 'RESERVATION_TIME',
            // 'SERVICE_AMOUNT',
            // 'STATUS_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
