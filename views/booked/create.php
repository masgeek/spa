<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\model_extended\RESERVED_SERVICES */

$this->title = 'Create Reserved  Services';
$this->params['breadcrumbs'][] = ['label' => 'Reserved  Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserved--services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
