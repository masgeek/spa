<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_SERVICES */

$this->title = $model->OFFERED_SERVICE_ID;
$this->params['breadcrumbs'][] = ['label' => 'My  Services', 'url' => ['index', 'id' => $model->SALON_ID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my--services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->OFFERED_SERVICE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->OFFERED_SERVICE_ID], [
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
            'OFFERED_SERVICE_ID',
            'SERVICE_ID',
            'SALON_ID',
            'SERVICE_COST',
        ],
    ]) ?>

</div>
