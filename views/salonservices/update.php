<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_SERVICES */

$this->title = 'Update Service: ' . $model->sERVICE->SERVICE_NAME;
$this->params['breadcrumbs'][] = ['label' => 'My  Services', 'url' => ['index','id'=>$model->SALON_ID]];
$this->params['breadcrumbs'][] = ['label' => $model->OFFERED_SERVICE_ID, 'url' => ['view', 'id' => $model->OFFERED_SERVICE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="my--services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
