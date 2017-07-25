<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\model_extended\MY_SERVICES */

$this->title = 'Create My  Services';
$this->params['breadcrumbs'][] = ['label' => 'My  Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my--services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
