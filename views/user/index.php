<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\models_search\UserSearch */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

$this->params['breadcrumbs'][] = $this->title;

$accountType = \app\model_extended\ACCOUNT_STATUS_MODEL::TypeDropdown();
$accountStatus = \app\model_extended\ACCOUNT_STATUS_MODEL::StatusDropdown();

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    //'USER_ID',
    'SURNAME',
    'OTHER_NAMES',
    'EMAIL:email',
    'MOBILE_NO',
    //'ACCOUNT_STATUS',
    //'ACCOUNT_TYPE_ID',
    //'PASSWORD',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'ACCOUNT_TYPE_ID',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\USERS_MODEL */
            return $model->aCCOUNTTYPE->ACCOUNT_NAME;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => $accountType,
        'filterInputOptions' => ['placeholder' => '--Account Type--'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'pageSummary' => false,
        'editableOptions' => [
            'header' => 'Select Account Type',
            'formOptions' => ['action' => ['/user-status']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $accountType,
        ]
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'ACCOUNT_STATUS',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\model_extended\USERS_MODEL */
            return $model->aCCOUNTSTATUS->STATUS_NAME;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => false,//$accountStatus,
        'filterInputOptions' => ['placeholder' => '--Account Status--'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'pageSummary' => true,
        'editableOptions' => [
            'header' => 'Select Status',
            'formOptions' => ['action' => ['/user-status']],
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' => $accountStatus,
        ]
    ],
];
// the GridView widget (you must use kartik\grid\GridView)

//show the gridview
?>

    <h1><?= $this->title ?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'export' => false,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
]); ?>