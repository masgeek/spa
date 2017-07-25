<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Salons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Salon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SALON_ID',
            'SALON_NAME',
            'SALON_TEL',
            'SALON_LOCATION',
            'SALON_EMAIL:email',
            'SALON_WEBSITE',
             'SALON_IMAGE',
             'DESCRIPTION:ntext',
             'OWNER_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
