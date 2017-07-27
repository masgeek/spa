<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users  Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users  Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'USER_ID',
            'SURNAME',
            'OTHER_NAMES',
            'EMAIL:email',
            'MOBILE_NO',
            // 'ACCOUNT_STATUS',
            // 'ACCOUNT_TYPE_ID',
            // 'PASSWORD',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
