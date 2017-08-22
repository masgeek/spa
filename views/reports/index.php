<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models_search\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My  Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my--reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create My  Reservations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
