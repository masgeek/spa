<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

$this->title = 'Reserved  Services';
$this->params['breadcrumbs'][] = $this->title;

$StatusList = \app\model_extended\STAFF_MODEL::StaffDropdown(null);


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'RESERVED_SERVICE_ID',
    'OFFERED_SERVICE_ID',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'STAFF_ID',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\RESERVED_SERVICES */
            return $model->sTAFF->STAFF_NAME;
        },
        'pageSummary' => true,
        'editableOptions' => [
            'header' => 'Select Staff',
            'formOptions' => ['action' => ['/assign-service']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $StatusList,
        ]
    ],
    //'STAFF_ID',
    //'RESERVATION_ID',
    'RESERVATION_DATE',
    'RESERVATION_TIME',
    'SERVICE_AMOUNT',
    'STATUS_ID',
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{approve}',
        'buttons' => [
            'approve' => function ($url, $model, $key) {
                return $url;
            },
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            $url = '#';
            if ($action === 'approve') {
                $action = 'Add Service';
                $url = \yii\helpers\Url::toRoute(['//add-service']);
            }

            return Html::a($action, $url, [
                'data-method' => 'post',
                //'data-confirm' => 'Are you sure?',
                'id' => 'act-btn',
                'data-params' => [
                    'ACTION' => 'APPROVE',
                    'ID' => $model['ID'],
                    'TIMESTAMP' => $model['SUBMISSION_TIME'],
                    'EVENT_DETAIL_ID' => $model['EVENT_DETAIL_ID'],
                    'REGISTRATION_NUMBER' => $model['REGISTRATION_NUMBER'],
                    '_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-success btn-xs btn-block']);
        },
    ],
];
// the GridView widget (you must use kartik\grid\GridView)

//show the gridview
?>
<?= Html::a('Create Reserved  Services', ['create'], ['class' => 'btn btn-success']) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'export' => false,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
]); ?>