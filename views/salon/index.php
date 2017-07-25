<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Salons';
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'SALON_ID',
    'SALON_NAME',
    'SALON_TEL',
    'SALON_LOCATION',
    'SALON_EMAIL:email',
    'SALON_WEBSITE',
    'SALON_IMAGE',
    'DESCRIPTION:ntext',
    'OWNER_ID',
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
                $url = \yii\helpers\Url::toRoute(['//add-service','id'=>$model->SALON_ID]);
            }

            return Html::a($action, $url, [
                //'data-method' => 'GET',
                //'data-confirm' => 'Are you sure?',
                //'id' => 'act-btn',
                //'data-params' => [
                    //'ID' => $model->SALON_ID,
                    //'_csrf' => Yii::$app->request->csrfToken
                //],
                'class' => 'btn btn-success btn-xs btn-block']);
        },
    ],
];
?>
<div class="salon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Salon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false,
        'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'toggleData' => true,
    ]); ?>
</div>
