<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\model_extended\RESERVED_SERVICES */

$this->title = $model->RESERVED_SERVICE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reserved  Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserved--services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->RESERVED_SERVICE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RESERVED_SERVICE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'RESERVED_SERVICE_ID',
            'OFFERED_SERVICE_ID',
            'STAFF_ID',
            'RESERVATION_ID',
            'RESERVATION_DATE',
            'RESERVATION_TIME',
            'SERVICE_AMOUNT',
            'STATUS_ID',
        ],
    ]) ?>

</div>
