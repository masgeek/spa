<?php
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models_search\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'SERVICE_ID',
        //'width' => '10%',
        'value' => function ($model, $key, $index, $widget) {
            ///$data = \app\model_extended\ALL_SERVICES::findOne($model->SERVICE_ID)->SERVICE_NAME;
            $data = $model->sERVICE->SERVICE_NAME;
            return $data;
        },
        'group' => true,  // enable grouping
        'groupedRow' => false,
        'pageSummaryFunc' => GridView::F_COUNT,
        'pageSummary' => true,
        'groupFooter' => function ($model, $key, $index, $widget) { // Closure method

            return [
                //'mergeColumns'=>[[2,2]], // columns to merge in summary
                'content' => [             // content to show in each summary cell
                    1 => "Summary for booking [{$model->SERVICE_NAME}]",
                    3 => GridView::F_COUNT,
                    //4 => "Total Cost",
                    //5 => "Balance",
                    //4=>GridView::F_AVG,
                    //4=>GridView::F_SUM,
                ],
                'contentFormats' => [      // content reformatting for each summary cell
                    3 => ['format' => 'number', 'decimals' => 0],
                    //4=>['format'=>'number', 'decimals'=>2],
                    //6=>['format'=>'number', 'decimals'=>2],
                ],
                'contentOptions' => [      // content html attributes for each summary cell
                    1 => ['style' => 'font-variant:small-caps'],
                    2 => ['style' => 'text-align:right'],
                    3 => ['style' => 'text-align:right'],
                    4 => ['style' => 'font-variant:small-caps'],
                    5 => ['style' => 'font-variant:small-caps'],
                    //6=>['style'=>'text-align:right'],
                ],
                // html attributes for group summary row
                'options' => ['class' => 'success', 'style' => 'font-weight:bold;']
            ];
        }

    ],
    [
        'attribute' => 'CUSTOMER_NAMES',
        'value' => function ($model) {
            $customer = \app\model_extended\MY_RESERVATIONS::GetCustomerInfo($model->RESERVATION_ID);
            return "{$customer->SURNAME} {$customer->OTHER_NAMES}";
        }

    ],
    [
        'attribute' => 'SALON_NAME',

    ],
    [
        'label' => Yii::t('app', "Date"),
        'attribute' => 'RESERVATION_DATE',
        //'value' => 'RESERVATION_DATE',
        'format' => 'date',
        'filter' => \kartik\daterange\DateRangePicker::widget([
            'model' => $searchModel,
            'attribute' => 'RESERVATION_DATE',
            'convertFormat' => true,
            'startAttribute' => 'START_DATE',
            'endAttribute' => 'END_DATE',
            //'hideInput'=>true,
            'presetDropdown' => true,
            'pluginOptions' => [

                'locale' => [
                    'format' => 'Y-m-d',
                    'separator' => ' TO '
                ],
            ],
        ]),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'TOTAL_COST',
        'format' => 'currency',
        'pageSummaryFunc' => GridView::F_SUM,
        'pageSummary' => true,
    ],
    //'STATUS_ID',
    'sTATUS.STATUS_NAME',
    'PAYMENT_REF',
    'MPESA_REF',
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'BOOKING_AMOUNT',
        'format' => 'currency',
        'pageSummaryFunc' => GridView::F_SUM,
        'pageSummary' => true,
    ]
]
?>


<?= GridView::widget([
    'id' => 'all-reservations',
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
   // 'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
    'layout'=>"{items}",
    'export' => false,
    //'autoXlFormat' => true,
    /*'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],*/
    'columns' => $gridColumns,
    'responsive' => false,
    'hover' => false,
    'toggleData' => false,
    'pjax' => false,
    'showPageSummary' => true,
]); ?>
