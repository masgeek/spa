<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */

$this->title = 'Update Salon: ' . $model->SALON_ID;
$this->params['breadcrumbs'][] = ['label' => 'Salons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SALON_ID, 'url' => ['view', 'id' => $model->SALON_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
