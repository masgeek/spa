<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

$this->title = 'Reserved  Services';
$this->params['breadcrumbs'][] = $this->title;

$salonList = Yii::$app->user->identity->mysalons;


$staffList = \app\model_extended\STAFF_MODEL::StaffDropdown($salonList);
$statusList = \app\model_extended\STATUS_MODEL::GetStatus();


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'RESERVED_SERVICE_ID',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\RESERVED_SERVICES */
            return $model->oFFEREDSERVICE->sERVICE->SERVICE_NAME;
        },
    ],
    //'OFFERED_SERVICE_ID',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'STAFF_ID',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\RESERVED_SERVICES */
            $staff_name = 'Not Assigned';
            if ($model->sTAFF != null) {
                $staff_name = $model->sTAFF->STAFF_NAME;
            }

            return $staff_name;
        },
        'pageSummary' => true,
        'editableOptions' => [
            'header' => 'Select Staff',
            'formOptions' => ['action' => ['/assign-service']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $staffList,
        ]
    ],
    //'STAFF_ID',
    //'RESERVATION_ID',
    'RESERVATION_DATE:date',
    'RESERVATION_TIME:time',
    'SERVICE_AMOUNT:currency',
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
            'formOptions' => ['action' => ['/confirm-service']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $statusList,
        ]
    ]
];
// the GridView widget (you must use kartik\grid\GridView)

//show the gridview
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'export' => false,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
]); ?>