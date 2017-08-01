<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;

$statusList = \app\model_extended\STATUS_MODEL::GetStatus();


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        //lets build the document link
        'attribute' => 'RESERVER_ID',
        'format' => 'raw',
        'value' => function ($model, $key, $index) {
            /* @var $model \app\model_extended\MY_RESERVATIONS_VIEW */
            $data = \app\model_extended\USERS_MODEL::findOne($model->RESERVER_ID);

            $full_names = "$data->SURNAME $data->OTHER_NAMES";

            return $full_names;
        }
    ],
    'SALON_NAME',
    //'OWNER_ID',
    'RESERVATION_DATE:date',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'STATUS_ID',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\RESERVED_SERVICES */
            $data = 'Pending';
            if ($model->STATUS_ID != null) {
                $data = \app\model_extended\STATUS_MODEL::findOne($model->STATUS_ID)->STATUS_NAME;
            }
            return $data;
        },
        'pageSummary' => true,
        'editableOptions' => [
            'header' => 'Select Status',
            'formOptions' => ['action' => ['/confirm-reservation']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $statusList,
        ]
    ],
    'TOTAL_COST:currency',
    [
        //'header' => 'Amount Paid',
        'attribute' => 'BOOKING_AMOUNT',
        'format' => 'currency',
        'value' => function ($model, $key, $index) {
            /* @var $model \app\model_extended\MY_RESERVATIONS_VIEW */
            $data = $model->getPaymentInfo();
            if ($data != null) {
                return $data->BOOKING_AMOUNT;
            }
        }
    ],
    [
        'attribute' => 'REMAINING_AMOUNT',
        'format' => 'currency',
        'value' => function ($model, $key, $index) {
            /* @var $model \app\model_extended\MY_RESERVATIONS_VIEW */
            $data = $model->getPaymentInfo();
            if ($data != null) {
                return $data->BALANCE;
            }
        }
    ],
    'ACCOUNT_REF',
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{assign}',
        'buttons' => [
            'assign' => function ($url, $model, $key) {
                return $url;
            },
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            $url = '#';
            if ($action === 'assign') {
                $action = 'Assign Staff';
                $url = \yii\helpers\Url::toRoute(['booked/assign-staff']);
            }

            return Html::a($action, $url, [
                'data-method' => 'get',
                'id' => 'act-btn',
                'data-params' => [
                    'reservation_id' => $model->RESERVATION_ID,
                    //'_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-success btn-xs btn-block']);
        },
    ],
];
?>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'toggleData' => true,
    ]); ?>

</div>
