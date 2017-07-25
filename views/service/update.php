<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = 'Update Services: ' . $model->SERVICE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SERVICE_ID, 'url' => ['view', 'id' => $model->SERVICE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
