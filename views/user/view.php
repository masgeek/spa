<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\model_extended\USERS_MODEL */

$this->title = $model->USER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Users  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users--model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->USER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->USER_ID], [
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
            'USER_ID',
            'SURNAME',
            'OTHER_NAMES',
            'EMAIL:email',
            'MOBILE_NO',
            'ACCOUNT_STATUS',
            'ACCOUNT_TYPE_ID',
            'PASSWORD',
        ],
    ]) ?>

</div>
