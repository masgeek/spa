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


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SALON_NAME',
            //'OWNER_ID',
            'RESERVATION_DATE:date',
            ///'STATUS_ID',
            [
                //lets build the document link
                'attribute' => 'STATUS_ID',
                'format' => 'raw',
                'value' => function ($model, $key, $index) {
                    $data = 'Pending';
                    if ($model->STATUS_ID != null) {
                        $data = \app\model_extended\STATUS_MODEL::findOne($model->STATUS_ID)->STATUS_NAME;
                    }
                    return $data;
                }
            ],
            'TOTAL_COST:decimal',
            'BOOKING_AMOUNT:decimal',
            'ACCOUNT_REF',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
