<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\model_extended\RESERVED_SERVICES */

$this->title = 'Update Reserved  Services: ' . $model->RESERVED_SERVICE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Reserved  Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RESERVED_SERVICE_ID, 'url' => ['view', 'id' => $model->RESERVED_SERVICE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reserved--services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
