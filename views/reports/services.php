<?php

//use yii\helpers\Html;
use  kartik\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models_search\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salons Services Reservations';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    //'RESERVATION_DATE',


    [
        'attribute' => 'SALON_NAME',
        //'width' => '10%',
        'value' => function ($model, $key, $index, $widget) {
            ///$data = \app\model_extended\ALL_SERVICES::findOne($model->SERVICE_ID)->SERVICE_NAME;
            //$data = $model->sERVICE->SERVICE_NAME;
            return $model->SALON_NAME;
        },
        'group' => true,  // enable grouping
        'groupedRow' => false,
        'pageSummaryFunc'=>GridView::F_COUNT,
        'pageSummary' => true,

    ],
    [
        'attribute' => 'SERVICE_NAME',
    ],
    'RESERVATIONS'
]
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    //'export' => false,
    'autoXlFormat' => true,
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
    'pjax' => false,
    'showPageSummary' => true,
    'panel' => [
        'type' => 'primary',
        //'heading'=>'Products'
    ]
]); ?>
