<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */

$this->title = $model->SALON_NAME;
$this->params['breadcrumbs'][] = ['label' => 'Salons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SALON_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SALON_ID], [
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
            //'SALON_ID',
            'SALON_NAME',
            'SALON_TEL',
            'SALON_LOCATION',
            'SALON_EMAIL:email',
            'SALON_WEBSITE:url',
            'SALON_IMAGE:image',
            'DESCRIPTION:ntext',
            //'OWNER_ID',
        ],
    ]) ?>

</div>
